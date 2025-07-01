<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class ImportSqlDumps extends Command
{
    protected $signature = 'import:sql-dumps {path? : The directory of .sql files}';
    protected $description = 'Import all .sql files in a directory into the current database';

    public function handle()
    {
        $path = $this->argument('path') ?? base_path('database/dumps');

        if (!is_dir($path)) {
            $this->error("Directory does not exist: $path");
            return 1;
        }

        $files = glob($path . '/*.sql');

        if (empty($files)) {
            $this->info("No .sql files found in $path");
            return 0;
        }

        $this->info("Importing " . count($files) . " file(s)...");

        $dbConfig = config('database.connections.mysql');

        dump('mysql -h%s -u%s -p%s %s < %s',
                escapeshellarg($dbConfig['host']),
                escapeshellarg($dbConfig['username']),
                escapeshellarg($dbConfig['password']),
                escapeshellarg($dbConfig['database']),
                escapeshellarg('/file/path.sql'));

        foreach ($files as $file) {
            $this->line("→ Importing: " . basename($file));

//            $process = Process::fromShellCommandline(sprintf(
//                'mysql -h%s -u%s -p%s %s < %s',
//                escapeshellarg($dbConfig['host']),
//                escapeshellarg($dbConfig['username']),
//                escapeshellarg($dbConfig['password']),
//                escapeshellarg($dbConfig['database']),
//                escapeshellarg($file)
//            ));

            $command = sprintf(
                'mysql -h%s -u%s %s %s < %s',
                escapeshellarg($dbConfig['host']),
                escapeshellarg($dbConfig['username']),
                $dbConfig['password'] !== '' ? '-p' . escapeshellarg($dbConfig['password']) : '',
                escapeshellarg($dbConfig['database']),
                escapeshellarg($file)
            );

            $process = Process::fromShellCommandline($command);


            $process->setTimeout(null);
            $process->run();

            if (!$process->isSuccessful()) {
                $this->error("❌ Failed to import $file");
                $this->error($process->getErrorOutput());
            } else {
                $this->info("✅ Done");
            }
        }

        return 0;
    }
}
