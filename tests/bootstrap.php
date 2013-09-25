<?php
set_include_path(dirname(__FILE__) . '/../' . PATH_SEPARATOR . get_include_path());

//require( getcwd().'/bootstrap.php');
require_once 'Slim/Slim.php';
require_once 'Logilim/Autoloader.php';
require 'StickORM/Autoloader.php';

// Register Slim's autoloader
\Slim\Slim::registerAutoloader();
\Logilim\Autoloader::registrar();

\StickORM\Autoloader::registerLoader();

//Register non-Slim autoloader
function customAutoLoader( $class )
{
    $file = rtrim(dirname(__FILE__), '/') . '/' . $class . '.php';
    echo "\n".$file."\n";
    if ( file_exists($file) ) {
        require $file;
    } else {
        return;
    }
}
spl_autoload_register('customAutoLoader');
