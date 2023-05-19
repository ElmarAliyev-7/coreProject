<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Core\Controller;

class AboutController extends Controller
{
    public function index(): string
    {
        return 'About us Page';
    }
}