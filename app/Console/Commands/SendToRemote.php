<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
        $this->info('Zipping SQL files from: ' . $sqlDir);

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
            $this->info('adding file: ' . basename($file));
            $zip->addFile($file, basename($file));
        }

        $this->info('closing zip file...');
        $zip->close();

        $this->info("Zipped " . count($files) . " file(s) to $zipPath");

        // Upload the zip file to the remote server
        $remoteServer = config('app.remote_server');
        if (!$remoteServer) {
            $this->error("Remote server not configured (config('app.remote_server')).");
            return 1;
        }

        $endpoint = rtrim($remoteServer, '/').'/api/upload-sql-zip';

        $this->info("Uploading zip to $endpoint ...");

        try {
            $response = Http::attach(
                'sql_zip',
                file_get_contents($zipPath),
                'sql_dumps.zip'
            )->post($endpoint);

            if ($response->successful()) {
                $this->info('Upload successful: ' . $response->json('message'));
            } else {
                $this->error('Upload failed: ' . $response->body());
                return 1;
            }
        } catch (\Exception $e) {
            $this->error('Upload exception: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
