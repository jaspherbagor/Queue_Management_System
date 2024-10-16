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
}
