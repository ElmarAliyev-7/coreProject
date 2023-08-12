<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();

        //Auth user bosdusa logine yonelt
        if(!isset($_SESSION['authUser'])) {
            return die(header("Location:http://localhost:8080/admin"));
        }
    }

    public function index(): bool|string
    {
        return view('admin.dashboard');
    }
}
