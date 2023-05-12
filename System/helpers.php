<?php

use System\View;

/**
 * @param string $name
 * @param array $data
 * @return bool|string
 */
function view(string $name, array $data): bool|string
{
    return View::show($name, $data);
}