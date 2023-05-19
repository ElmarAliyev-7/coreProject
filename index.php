<?php

function autoloadClass($className)
{
    $className = strtolower(str_replace('\\', '/', $className)) . '.php';
    if(file_exists($className)) {
        require_once $className;
    }
}
spl_autoload_register('autoloadClass');

require_once 'routes/web.php';