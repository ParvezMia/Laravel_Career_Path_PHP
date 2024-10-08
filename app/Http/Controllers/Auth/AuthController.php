<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    public function logout() {
        Session::flush();
        Auth::logout();

        notify()->info('Logged out!');
        return Redirect()->route('login');
    }
}
