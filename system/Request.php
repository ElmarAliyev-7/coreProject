<?php

namespace System;

use JetBrains\PhpStorm\Pure;

class Request
{
    #[Pure] public static function get() : array
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