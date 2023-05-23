<?php

use JetBrains\PhpStorm\ArrayShape;
use System\View;
use App\Http\Controllers\Admin\{AuthController, BlogController, SliderController};

/**
 * @param string $name
 * @param array $data
 * @return bool|string
 */
function view(string $name, array $data = []): bool|string
{
    return View::show($name, $data);
}

/**
 * @param string $path
 * @return string
 */
function is_current(string $path): string
{
    return ($path == $_SERVER['REQUEST_URI']) ? 'active' : '';
}

/**
 * @param string $str
 * @param int $limit
 * @param string $ext
 * @return string
 */
function str_limit(string $str, int $limit, string $ext = '..'): string
{
    $str = substr($str, 0, $limit);
    return $str . $ext;
}

/**
 * @param mixed $data
 */
function dd(mixed $data)
{
    return die(var_dump($data));
}

#[ArrayShape(['status' => "int", 'message' => "string"])]
function storeBlog(): array
{
    return (new BlogController)->store();
}

function updateBlog(int $id): array
{
    return (new BlogController)->update($id);
}

#[ArrayShape(['status' => "int", 'message' => "string"])]
function storeSlider(): array
{
    return (new SliderController())->store();
}

#[ArrayShape(['status' => "int", 'message' => "string"])]
function destroyBlog(int $id): array
{
    return (new BlogController)->destroy($id);
}

#[ArrayShape(['status' => "int", 'message' => "string"])]
function destroySlider(int $id): array
{
    return (new SliderController)->destroy($id);
}

#[ArrayShape(['status' => "int", 'message' => "string"])]
function loginPost(): array
{
    return (new AuthController())->loginPost();
}