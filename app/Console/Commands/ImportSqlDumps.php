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

        foreach ($files as $file) {
            $this->info("Importing file to remote: " . basename($file));

            $sshUser = 'forge';
            $sshHost = '147.182.136.24';
            $remoteDb = 'forge';         // Change if needed
            $remoteUser = 'forge';       // Change if needed
            $mysqlPassword = 'ghG0zSer9XNlmhcSiglP';         // Set if needed

            $command = sprintf(
                'ssh %s@%s "mysql -u%s %s %s" < %s',
                $sshUser,
                $sshHost,
                $remoteUser,
                $mysqlPassword ? ('-p' . escapeshellarg($mysqlPassword)) : '',
                escapeshellarg($remoteDb),
                escapeshellarg($file)
            );

            $process = Process::fromShellCommandline($command);

            $result = $process->run();

            if ($process->isSuccessful()) {
                $this->info('Remote import success: ' . basename($file));
            } else {
                $this->error("Failed to import remotely: " . $process->getErrorOutput());
                return 1;
            }
        }


        return 0;
    }
}
