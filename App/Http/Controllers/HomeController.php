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
        $blogs = DB::table('blogs')->select('id')
            ->where(['status' => 1, 'title' => 'title 1'])
            ->all();
        return $blogs;
        return View::show('home', ['blogs' => $blogs]);
    }
}
