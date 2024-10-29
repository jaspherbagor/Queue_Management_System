<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisan;
use Illuminate\Support\Facades\File;

class DatabaseController extends Controller
{

    public function index()
    {
        return view('backend.admin.setting.backup_and_restore');
    }

    public function backupDatabase()
    {
        Artisan::call('backup:database');
        return redirect()->back()->with('success', 'Database backup completed successfully.');
    }

    // Method to trigger the restore command
    public function restoreDatabase(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file'
        ]);

        // Get the uploaded backup file
        $file = $request->file('backup_file');
        $fileName = $file->getClientOriginalName();
        $file->storeAs('backup', $fileName);

        // Call the restore command
        Artisan::call('restore:database', ['file' => $fileName]);

        return redirect()->back()->with('success', 'Database restored successfully.');
    }

    public function showBackups()
    {
        // Path to the backup-temp folder
        $backupPath = storage_path('app/backup');

        // Get all backup files in the folder
        $files = File::files($backupPath);

        // Pass files to the view
        return view('backend.admin.setting.backup_file', compact('files'));
    }

    public function downloadBackup($filename)
    {
        // Path to the backup-temp folder
        $filePath = storage_path('app/backup/' . $filename);

        // Check if the file exists
        if (File::exists($filePath)) {
            // Return a response to download the file
            return response()->download($filePath);
        } else {
            // Redirect back with an error if the file doesn't exist
            return redirect()->back()->with('error', 'File not found.');
        }
    }
}
