<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(): bool|string
    {
        return view('admin.auth.login');
    }

}