<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class SqlDumpController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'sql_zip' => 'required|file|mimes:zip|max:2048',
        ]);

        $file = $request->file('sql_zip');
        $path = $file->store('sql_dumps', 'local');

        // Extract the zip file
        $fullPath = storage_path('app/' . $path);
        $extractDir = storage_path('app/sql_dumps/' . pathinfo($file->hashName(), PATHINFO_FILENAME));

        if (!is_dir($extractDir)) {
            mkdir($extractDir, 0755, true);
        }

        $zip = new ZipArchive;
        if ($zip->open($fullPath) === true) {
            $zip->extractTo($extractDir);
            $zip->close();
        } else {
            return response()->json(['message' => 'Failed to extract zip file'], 500);
        }

        // Run the import:sql-dumps command on the extracted directory
        Artisan::call('import:sql-dumps', [
            'path' => $extractDir,
        ]);

        return response()->json([
            'message' => 'SQL dump uploaded and imported successfully',
            'path' => $path,
            'import_output' => Artisan::output(),
        ], 200);
    }
}
