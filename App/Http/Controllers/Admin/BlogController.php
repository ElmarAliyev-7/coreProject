<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use System\DB;

class BlogController extends Controller
{
    public function index(): bool|string
    {
        $blogs = DB::table('blogs')->all();
        return view('admin.blogs.index', ['blogs' => $blogs]);
    }
}