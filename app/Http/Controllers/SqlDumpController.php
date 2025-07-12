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
            'sql_zip' => 'required|file|mimes:zip',
        ]);
        Log::debug('SQL dump file validation passed');
        $file = $request->file('sql_zip');
        Log::debug('Uploaded file mime type: ' . $file->getMimeType());
        Log::debug('Uploaded file original name: ' . $file->getClientOriginalName());
        Log::debug('Uploaded file size: ' . $file->getSize());

        $path = $file->store('sql_dumps', 'local');
        Log::debug('SQL dump file stored in ' . $path);


        Log::debug("Stored file path: {$path}");
        Log::debug("Full path: " . storage_path('app/'.$path));
        Log::debug("File exists? " . (file_exists(storage_path('app/'.$path)) ? 'yes' : 'no'));

        // Extract the zip file
//        $fullPath = storage_path('app/' . $path);
        $fullPath = storage_path('app/private/' . $path);
        $extractDir = storage_path('app/private/sql_dumps/' . pathinfo($file->hashName(), PATHINFO_FILENAME));
//        $extractDir = storage_path('app/sql_dumps/' . pathinfo($file->hashName(), PATHINFO_FILENAME));

        if (!is_dir($extractDir)) {
            Log::debug('SQL dump directory does not exist: ' . $extractDir);
            mkdir($extractDir, 0755, true);
        }
        if (!is_dir($extractDir)) {
            Log::debug('still doesnt exit!!!!!');
            return response()->json(['message' => 'Failed to create extraction directory'], 500);
        }

        Log::debug('Extracting SQL dump to ' . $extractDir);
        $zip = new ZipArchive;
//        if ($zip->open($fullPath) === true) {
//            $zip->extractTo($extractDir);
//            $zip->close();
//        } else {
//            return response()->json(['message' => 'Failed to extract zip file'], 500);
//        }

        $result = $zip->open($fullPath);
        if ($result === true) {
            $zip->extractTo($extractDir);
            $zip->close();
        } else {
            Log::error("Failed to open zip: error code {$result}");
            return response()->json(['message' => 'Failed to extract zip file'], 500);
        }

        $mysqlDir = $extractDir .'/mysql';

        Log::debug('SQL dump extraction completed');
        // Run the import:sql-dumps command on the extracted directory
        Artisan::call('import:sql-dumps', [
            'path' => $mysqlDir,
        ]);
        Log::debug('SQL dump import command executed');

        return view('upload.finished', [
            'message' => 'SQL dump uploaded and imported successfully',
            'path' => $path,
            'import_output' => Artisan::output(),
        ]);

    }
}
