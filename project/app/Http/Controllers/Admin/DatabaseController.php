<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisan;

class DatabaseController extends Controller
{

    public function index()
    {
        return view('backend.admin.setting.backup_and_restore');
    }
    // Method to trigger the backup command
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
}
