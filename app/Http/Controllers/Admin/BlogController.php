<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\MediaTrait;
use JetBrains\PhpStorm\ArrayShape;
use System\{DB, Request};
use Exception;

class BlogController extends Controller
{

    public function __construct()
    {
        parent::__construct();

        //Auth user bosdusa logine yonelt
        if(!isset($_SESSION['authUser'])) {
            return die(header("Location:http://localhost:8080/admin"));
        }
    }

    /**
     * @return bool|string
     */
    public function index(): bool|string
    {
        $blogs = DB::table('blogs')->all();
        return view('admin.blogs.index', ['blogs' => $blogs]);
    }

    /**
     * @return bool|string
     */
    public function create(): bool|string
    {
        return view('admin.blogs.create');
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

    public function edit(int $id): bool|string
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        if($blog){
            return view('admin.blogs.edit', ['blog' => $blog]);
        }
        return '404 Not Found';
    }

    public function update(int $id): array
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
        endif;

        if($ok) :
            // Update Data
            $data = [];
            $data['title'] = $request['title'];
            $data['description'] = $request['description'];
            $data['cover'] = $request['old_cover'];
            $data['status'] = (isset($request['status']) and $request['status'] == 'on') ? 1 : 0;

            if(!empty($request['cover'])){
                $target_dir = "storage/uploads/blogs/";
                $file_name = strtotime("now") . $_FILES["cover"]["name"];
                $data['cover'] = $target_dir . $file_name;

                $media = new MediaTrait;
                // Upload Cover
                $media->uploadImage($file_name, $_FILES["cover"]["tmp_name"], $_FILES["cover"]["size"],$target_dir);
                // Remove Old Cover
                $media->deleteImage($request['old_cover']);
            }

            $update = DB::table('blogs')->update($data, $id);
            if($update) :
                return ['status' => 1, 'message' => 'Blog updated successfully'];
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