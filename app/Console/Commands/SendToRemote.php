<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendToRemote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:send-to-remote  {path? : The directory of .sql files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sqlDir = $this->argument('path') ?? base_path('database/dumps');
        $zipPath = rtrim($sqlDir, '/\\') . '/sql_dumps.zip';

        if (!is_dir($sqlDir)) {
            $this->error("SQL directory does not exist: $sqlDir");
            return 1;
        }

        // Remove old zip if exists
        if (file_exists($zipPath)) {
            unlink($zipPath);
        }

        $zip = new \ZipArchive();
        if ($zip->open($zipPath, \ZipArchive::CREATE) !== true) {
            $this->error("Could not create zip file at $zipPath");
            return 1;
        }

        $files = glob(rtrim($sqlDir, '/\\') . '/*.sql');
        if (empty($files)) {
            $this->info("No .sql files found in $sqlDir to zip.");
            $zip->close();
            return 0;
        }

        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }

        $zip->close();

        $this->info("Zipped " . count($files) . " file(s) to $zipPath");

        return 0;
    }
}
