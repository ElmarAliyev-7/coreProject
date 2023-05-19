<?php

use App\Http\Controllers\Admin\ {AuthController, Dashboard};
use App\Http\Controllers\{HomeController, AboutController, BlogController};

// Define a function to handle the home page
function homePage(): bool|string
{
    $home = new HomeController();
    return print_r($home->index());
}

// Define a function to handle the blogs page
function blogsPage(): bool|string
{
    $blogs = new BlogController();
    return print_r($blogs->index());
}

//Define a function to handle the blog show page
function blogShowPage($id = 1): bool|string
{
    $blog = new BlogController();
    return print_r($blog->show($id));
}

// Define a function to handle the create blog page
function createBlogPage(): bool|string
{
    $blogs = new BlogController();
    return print_r($blogs->create());
}

// Define a function to handle the about page
function aboutPage(): bool|string
{
    $about = new AboutController();
    return print_r($about->index());
}

// Define a function to handle the about page
function admin(): bool|string
{
    $admin = new AuthController();
    return print_r($admin->login());
}

// Define a function to handle the about page
function logOut(): bool|string
{
    $admin = new AuthController();
    return print_r($admin->logOut());
}

// Define a function to handle the about page
function adminDashboard(): bool|string
{
    $dasboard = new Dashboard();
    return print_r($dasboard->index());
}


// Get the requested URL and Segments
$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', $_SERVER['REQUEST_URI']);

// Map the requested URL to a corresponding action
if($requestUri == '/') :
    homePage();die();
elseif($requestUri == '/about' or $requestUri === '/about/') :
    aboutPage();die();
elseif($requestUri === '/blogs' or $requestUri === '/blogs/') :
    blogsPage();die();
elseif($segments[1] === 'blogs' and $segments[2] === 'show'):
    blogShowPage($segments[3]);die();
elseif($segments[1] === 'blogs' and $segments[2] === 'create') :
    createBlogPage();die();
elseif($requestUri == '/admin' or $requestUri == '/admin/') :
    admin();die();
elseif($requestUri == '/admin/dashboard' or $requestUri == '/admin/dashboard/') :
    adminDashboard();die();
elseif($requestUri == '/admin/logout' or $requestUri == '/admin/logout/') :
    logOut();die();
else :
    // Handle 404 error
    header("HTTP/1.0 404 Not Found");
    die("Page not found");
endif;
