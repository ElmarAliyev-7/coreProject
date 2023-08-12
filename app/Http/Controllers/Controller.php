<?php

namespace App\Http\Controllers;

class Controller
{
    public function __construct()
    {
        if(!isset($_SESSION)) session_start();
    }
}