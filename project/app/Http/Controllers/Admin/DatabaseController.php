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
        $file->storeAs('backup-temp', $fileName);

        // Call the restore command
        Artisan::call('restore:database', ['file' => $fileName]);

        return redirect()->back()->with('success', 'Database restored successfully.');
    }

    public function showBackups()
    {
        // Path to the backup-temp folder
        $backupPath = storage_path('app/backup-temp');

        // Get all backup files in the folder
        $files = File::files($backupPath);

        // Pass files to the view
        return view('backend.admin.setting.backup_file', compact('files'));
    }
}
