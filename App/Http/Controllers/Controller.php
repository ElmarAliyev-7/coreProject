<?php

namespace App\Http\Controllers;

use JetBrains\PhpStorm\Pure;

require_once 'System/helpers.php';

class Controller
{
    #[Pure] public static function request(): array
    {
        $request = [];
        foreach ($_REQUEST as $name => $value) :
            $request[$name] = self::sanitize_input($value);
        endforeach;

        foreach ($_FILES as $name => $value) :
            $request[$name] = self::sanitize_input($value['name']);
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