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
        $blogs = DB::table('blogs')->select('id' , 'title', 'description', 'cover')
            ->where('status', 1)->get();
        return view('home', ['blogs' => $blogs]);
    }
}
