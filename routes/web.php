<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;

// Define a function to handle the home page
function homePage(){
    $home = new HomeController();
    return print_r($home->index());
}

// Define a function to handle the about page
function aboutPage() {
    $about = new AboutController();
    return print_r($about->index());
}

// Get the requested URL
$requestUri = $_SERVER['REQUEST_URI'];

// Map the requested URL to a corresponding action
switch ($requestUri) {
    case '/':
        homePage();
        break;
    case '/about':
        aboutPage();
        break;
    default:
        // Handle 404 error
        header("HTTP/1.0 404 Not Found");
        echo "Page not found";
        break;
}
