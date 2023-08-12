<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use System\DB;

class HomeController extends Controller
{
    /**
     * @return bool|string
     */
    public function index(): bool|string
    {
        $sliders = DB::table('sliders')->all();
        $blogs = DB::table('blogs')->select('id' , 'title', 'description', 'cover')
            ->where('status', 1)->get();
        return view('front.home', ['sliders' => $sliders, 'blogs' => $blogs]);
    }
}
