<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserManualController extends Controller
{
    public function index()
    {
        return view('backend.admin.user_manual.user_manual');
    }
}
