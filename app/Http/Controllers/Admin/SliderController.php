<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\MediaTrait;
use JetBrains\PhpStorm\ArrayShape;
use System\{DB, Request};
use Exception;

class SliderController extends Controller
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
        $sliders = DB::table('sliders')->all();
        return view('admin.sliders.index', ['sliders' => $sliders]);
    }

    /**
     * @return bool|string
     */
    public function create(): bool|string
    {
        return view('admin.sliders.create');
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
        elseif(empty($request['title_bold'])) :
            $ok = 0;
            array_push($messages, 'Title Bold is required');
        elseif(empty($request['subhead'])) :
            $ok = 0;
            array_push($messages, 'SubHead is required');
        elseif(empty($request['image'])) :
            $ok = 0;
            array_push($messages, 'Image is required');
        endif;

        if($ok) :
            $target_dir = "storage/uploads/sliders/";
            $file_name = strtotime("now") . $_FILES["image"]["name"];
            // Insert Data
            $data = [];
            $data['title'] = $request['title'];
            $data['title_bold'] = $request['title_bold'];
            $data['subhead'] = $request['subhead'];
            $data['description'] = $request['description'];
            $data['image'] = $target_dir . $file_name;
            $insert = DB::table('sliders')->create($data);

            // Upload Image
            $upload = (new MediaTrait)
                ->uploadImage($file_name, $_FILES["image"]["tmp_name"], $_FILES["image"]["size"],$target_dir);

            if($insert and $upload['uploadOk']) :
                return ['status' => 1, 'message' => 'Slider created successfully'];
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
            $slider = DB::table('sliders')->where(['id' => $id])->first();
            (new MediaTrait)->deleteImage($slider['image']);
            DB::table('sliders')->delete($id);
            return ['status' => 1, 'message' => 'Slider Deleted Successfully'];
        }catch (Exception $e) {
            return ['status' => 0, 'message' => $e->getMessage()];
        }
    }

}