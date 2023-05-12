<?php

namespace App\Http\Controllers;

use System\DB;
use System\View;

class HomeController
{
    /**
     * @return bool|string
     */
    public function index(): bool|string
    {
        $blogs = DB::table('blogs')->select('id, title, description, cover')
            ->where(['title' => 'title 2'])->all();
        return View::show('home', ['blogs' => $blogs]);
    }

    public function __destruct()
    {
        DB::closeConnection();
    }
}
