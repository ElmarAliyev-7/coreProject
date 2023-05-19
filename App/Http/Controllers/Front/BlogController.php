<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Core\Controller;
use System\DB;

class BlogController extends Controller
{
    /**
     * @return bool|string
     */
    public function index(): bool|string
    {
        $blogs = DB::table('blogs')->all();
        return view('front.blogs.index', ['blogs' => $blogs]);
    }

    /**
     * @param int $id
     * @return bool|string
     */
    public function show(int $id): bool|string
    {
        $blog = DB::table('blogs')->where(['id' => $id])->first();
        $blog['status'] = ($blog['status'] == 1) ? 'Active' : 'Passive';
        return view('front.blogs.show', ['blog' => $blog]);
    }
}