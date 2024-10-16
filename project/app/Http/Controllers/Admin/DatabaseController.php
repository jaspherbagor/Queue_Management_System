<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artisan;

class DatabaseController extends Controller
{
    // Method to trigger the backup command
    public function backupDatabase()
    {
        Artisan::call('backup:database');

        return redirect()->back()->with('success', 'Database backup completed successfully.');
    }
}
