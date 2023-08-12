<?php

namespace System;

class View
{
    public static function show(string $viewName, array $data): bool|string
    {
        extract($data);
        $viewName = str_replace('.', '/', $viewName);
        ob_start();
        require dirname(__DIR__) . '/resources/views/' . $viewName . '.php';
        return ob_get_clean();
    }
}
