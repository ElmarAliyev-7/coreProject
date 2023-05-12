<?php

namespace App\Http\Controllers;

use System\DB;
use System\View;

class HomeController
{
    /**
     * @return bool|string
     */
    public function index()
    {
        $blogs = DB::table('blogs')->all();
        return View::show('home', ['blogs' => $blogs]);
    }
}
