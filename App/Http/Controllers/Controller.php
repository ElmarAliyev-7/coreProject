<?php

namespace App\Http\Controllers;

require_once 'System/helpers.php';

class Controller
{
    public function __construct()
    {
        if(!isset($_SESSION)) session_start();
    }
}