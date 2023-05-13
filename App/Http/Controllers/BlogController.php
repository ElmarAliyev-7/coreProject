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
        $blog['status'] = ($blog['status'] == 1) ? 'Active' : 'Passive';
        return view('blogs.show', ['blog' => $blog]);
    }

    public function store(): string
    {
        $ok = 1;
        $messages = [];
        $request = parent::request();

        if(empty($request['title'])) :
            $ok = 0;
            array_push($messages, 'Title is required');
        elseif(empty($request['description'])) :
            $ok = 0;
            array_push($messages, 'Description is required');
        elseif(empty($request['cover'])) :
            $ok = 0;
            array_push($messages, 'Cover is required');
        endif;

        if($ok) :
            $data = [];
            $data['title'] = $request['title'];
            $data['description'] = $request['description'];
            $data['cover'] = $request['cover'];
            $data['status'] = (isset($request['status']) and $request['status'] == 'on') ? 1 : 0;
            $result = DB::table('blogs')->create($data);
            return ($result) ? 'Blog created successfully' : 'Error Occurred';
        else :
            return $messages[0];
        endif;
    }
}