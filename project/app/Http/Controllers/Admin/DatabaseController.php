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
    // Method to trigger the backup command
    public function backupDatabase()
    {
        // Trigger the artisan command for database backup
        Artisan::call('backup:database');

        // Retrieve the output of the command (which is the backup file path)
        $filePath = trim(Artisan::output());

        // Modify the file path to match the backup-temp folder
        $filePath = storage_path('app/backup-temp/' . basename($filePath));

        // Check if the backup file exists at the path
        if (File::exists($filePath)) {
            // Download the file without deleting it from the server
            return response()->download($filePath);
        } else {
            // If the file doesn't exist, show an error message
            return redirect()->back()->with('error', 'Failed to create database backup.');
        }
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
}
