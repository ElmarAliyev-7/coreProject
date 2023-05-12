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
        $blogs = DB::table('blogs')->select('id, title, description, cover, status')->all();
        return view('blogs.index', ['blogs' => $blogs]);
    }

    /**
     * @return bool|string
     */
    public function create(): bool|string
    {
        return view('blogs.create');
    }

    public function store()
    {
        $request = parent::request();
        $blog = DB::table('blogs')->create($request);
        return print_r($blog);
//        return ($blog) ? 'success' : 'error';
    }
}