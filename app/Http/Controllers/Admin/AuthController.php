<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use JetBrains\PhpStorm\ArrayShape;
use System\{DB, Request};

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(): bool|string
    {
        //Auth user varsa dashboarda yonelt
        if(isset($_SESSION['authUser'])) {
            return die(header("Location:http://localhost:8080/admin/dashboard"));
        }

        return view('admin.auth.login');
    }

    public function loginPost()
    {
        //Auth user varsa dashboarda yonelt
        if(isset($_SESSION['authUser'])) {
            return die(header("Location:http://localhost:8080/admin/dashboard"));
        }

        $request = Request::get();
        $email = $request['email'];
        $password = $request['password'];
        $user = DB::table('users')->where(['email' => $email, 'password' => $password])->first();
        return dd($user);
        if($user){
            $_SESSION['authUser'] = $user;
            return ['status' => 1, 'message' => 'Login Successfully'];
        }
        return ['status' => 0, 'message' => 'Credentials doesn\'t match'];
    }

    public function logout()
    {
        session_destroy();
        return header("Location:http://localhost:8080/admin");
    }
}