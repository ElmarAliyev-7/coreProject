<?php

namespace App\Http\Controllers;

use System\DB;

class BlogController extends Controller
{
    /**
     * @return bool|string
     */
    public function index(): bool|string
    {
        $blogs = DB::table('blogs')->select('id, title, description, cover')->where(['status' => 1])->all();
        return view('blogs.index', ['blogs' => $blogs]);
    }

    public function create(): bool|string
    {
        return view('blogs.create');
    }
}