<?php

function autoloadClass($className)
{
    $className = strtolower(str_replace('\\', '/', $className)) . '.php';
    require_once $className;
}
spl_autoload_register('autoloadClass');

require_once 'routes/web.php';