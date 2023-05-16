<?php

namespace App\Http\Controllers;

use System\DB;

class HomeController extends Controller
{
    /**
     * @return bool|string
     */
    public function index(): bool|string
    {
        $blogs = DB::table('blogs')->select('id' , 'title', 'description', 'cover')->get();
        //->where(['status' => 1])
        return view('home', ['blogs' => $blogs]);
    }
}
