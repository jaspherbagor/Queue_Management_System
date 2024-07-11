<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function forgot_password() {
        return view('authentication.forgot_password');
    }

    public function reset_password() {
        return view('authentication.reset_password');
    }
}
