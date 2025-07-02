<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class SqlDumpController extends Controller
{
    public function upload(Request $request)
    {
        Log::debug('SQL dump upload initiated');
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', -1);

        $request->validate([
            'sql_zip' => 'required|file|mimes:zip|max:2048',
        ]);
        Log::debug('SQL dump file validation passed');

        $file = $request->file('sql_zip');
        $path = $file->store('sql_dumps', 'local');
        Log::debug('SQL dump file stored in ' . $path);

        // Extract the zip file
        $fullPath = storage_path('app/' . $path);
        $extractDir = storage_path('app/sql_dumps/' . pathinfo($file->hashName(), PATHINFO_FILENAME));

        if (!is_dir($extractDir)) {
            Log::debug('SQL dump directory does not exist: ' . $extractDir);
            mkdir($extractDir, 0755, true);
        }

        Log::debug('Extracting SQL dump to ' . $extractDir);
        $zip = new ZipArchive;
        if ($zip->open($fullPath) === true) {
            $zip->extractTo($extractDir);
            $zip->close();
        } else {
            return response()->json(['message' => 'Failed to extract zip file'], 500);
        }

        Log::debug('SQL dump extraction completed');
        // Run the import:sql-dumps command on the extracted directory
        Artisan::call('import:sql-dumps', [
            'path' => $extractDir,
        ]);
        Log::debug('SQL dump import command executed');

        return response()->json([
            'message' => 'SQL dump uploaded and imported successfully',
            'path' => $path,
            'import_output' => Artisan::output(),
        ], 200);
    }
}
