<?php

namespace App\Http\Controllers;

require_once 'System/helpers.php';
use System\DB;

class HomeController
{
    /**
     * @return bool|string
     */
    public function index(): bool|string
    {
        $blogs = DB::table('blogs')->select('id, title, description, cover')
            ->where(['title' => 'title 2'])->all();
        return view('home', ['blogs' => $blogs]);
    }

    public function __destruct()
    {
        DB::closeConnection();
    }
}
