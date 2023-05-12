<?php

use System\View;

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