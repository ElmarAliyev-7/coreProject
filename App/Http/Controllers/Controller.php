<?php

namespace App\Http\Controllers;

require_once 'System/helpers.php';

class Controller
{
    public static function request()
    {
        $request = [];

        foreach ($_REQUEST as $name => $value) :
            $request[$name] = self::sanitize_input($value);
        endforeach;
        return $request;
    }

    /**
     * @param $input
     * @return string
     */
    public static function sanitize_input($input): string
    {
        return trim(htmlspecialchars($input));
    }
}