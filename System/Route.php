<?php

namespace System;

final class Route
{
    private static string $requestUri;
    private static array $routes;

    public static function get(string $path, $controller, $method)
    {
        self::$routes[$path] = ['controller' => $controller, 'method' => $method];
    }

    public static function run()
    {
        self::$requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', self::$requestUri);

        foreach (self::$routes as $path => $route) {
            $controller = new $route['controller'];

            if(isset($segments[2]) && $segments[2] === 'show' && $route['method'] === 'show') {
                return print_r($controller->{$route['method']}($segments[3]));
            }

            if(isset($segments[3]) && $segments[3] === 'edit' && $route['method'] === 'edit') {
                return print_r($controller->{$route['method']}($segments[4]));
            }

            if(in_array(self::$requestUri, [$path, $path.'/'])) {
                return print_r($controller->{$route['method']}());
            }
        }
        // Handle 404 error
        header("HTTP/1.0 404 Not Found");
        return die("Page not found");
    }

}