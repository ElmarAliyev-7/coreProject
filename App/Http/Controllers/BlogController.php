<?php

namespace App\Http\Controllers;

use JetBrains\PhpStorm\ArrayShape;
use Exception;
use System\DB;
use System\Request;
use App\Http\Traits\MediaTrait;

class BlogController extends Controller
{
    /**
     * @return bool|string
     */
    public function index()
    {
        $blogs = DB::table('blogs')->select('id, title, description, cover, status')->get();
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


    #[ArrayShape(['status' => "int", 'message' => "string"])]
    public function store(): array
    {
        $ok = 1;
        $messages = [];
        $request = Request::get();

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
            $target_dir = "storage/uploads/blogs/";
            $file_name = strtotime("now") . $_FILES["cover"]["name"];
            // Insert Data
            $data = [];
            $data['title'] = $request['title'];
            $data['description'] = $request['description'];
            $data['cover'] = $target_dir . $file_name;
            $data['status'] = (isset($request['status']) and $request['status'] == 'on') ? 1 : 0;
            $insert = DB::table('blogs')->create($data);

            // Upload Cover
            $upload = (new MediaTrait)
                ->uploadImage($file_name, $_FILES["cover"]["tmp_name"], $_FILES["cover"]["size"],$target_dir);

            if($insert and $upload['uploadOk']) :
                return ['status' => 1, 'message' => 'Blog created successfully'];
            else :
                return ['status' => 0, 'message' => $messages[0]];
            endif;
        else :
            return ['status' => 0, 'message' => $messages[0]];
        endif;
    }

    #[ArrayShape(['status' => "int", 'message' => "string"])]
    public function destroy(int $id): array
    {
        try {
            $blog = DB::table('blogs')->where(['id' => $id])->first();
            (new MediaTrait)->deleteImage($blog['cover']);
            DB::table('blogs')->delete($id);
            return ['status' => 1, 'message' => 'Blog Deleted Successfully'];
        }catch (Exception $e) {
            return ['status' => 0, 'message' => $e->getMessage()];
        }
    }
}