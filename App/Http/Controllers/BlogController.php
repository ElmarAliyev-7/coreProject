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

    /**
     * @param int $id
     * @return bool|string
     */
    public function show(int $id): bool|string
    {
        $blog = DB::table('blogs')->where(['id' => $id])->first();
        $blog['status'] = ($blog['status'] == 1) ? 'Active' : 'Passiv';
        return view('blogs.show', ['blog' => $blog]);
    }

    public function store()
    {
        $request = parent::request();
        $blog = DB::table('blogs')->create($request);
        return print_r($blog);
//        return ($blog) ? 'success' : 'error';
    }
}