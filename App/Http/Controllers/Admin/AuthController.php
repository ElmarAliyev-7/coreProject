<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Core\Controller;
use JetBrains\PhpStorm\ArrayShape;
use System\DB;
use System\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        //Auth user varsa dashboarda yonelt
        if(isset($_SESSION['authUser'])) {
            return die(header("Location:http://localhost:8080/admin/dashboard"));
        }
    }

    public function login(): bool|string
    {
        return view('admin.auth.login');
    }

    #[ArrayShape(['status' => "int", 'message' => "string"])]
    public function loginPost(): array
    {
        $request = Request::get();
        $email = $request['email'];
        $password = $request['password'];
        $user = DB::table('users')->where(['email' => $email, 'password' => $password])->first();

        if($user){
            $_SESSION['authUser'] = $user;
            return ['status' => 1, 'message' => 'Login Successfully'];
        }
        return ['status' => 0, 'message' => 'Credentials doesn\'t match'];
    }

    public function logOut()
    {
        session_destroy();
        return header("Location:http://localhost:8080/admin");
    }
}