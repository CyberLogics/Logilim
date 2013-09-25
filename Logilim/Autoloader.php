<?php
/**
 * Created as Autoloader.php.
 * Developer: Hamza Waqas
 * Date:      2/1/13
 * Time:      4:42 PM
 */

namespace Logilim;

class Autoloader {

    const SOURCE_CODE_DIR = "protected";

    const SOURCE_CODE_SUB_DIR = "classes";

    const SOURCE_MIDDLEWARE_DIR = 'middleware';

    const SOURCE_CODE_EXT = "Entity";

    const SOURCE_MIDDLEWARE_EXT = 'Middleware';

    const SOURCE_CODE_EXT_SEPARATOR = '.';

    public static function registrar() {
        spl_autoload_register(__NAMESPACE__."\\Autoloader::_autoload");
    }

    public static function _autoload($class) {
        $last_char = substr($class,-1);
        if ($last_char == 'E') {

            $clean_name = substr($class,0,-1);

            $class_path = DOCROOT.DS.self::SOURCE_CODE_DIR.DS.self::SOURCE_CODE_SUB_DIR.DS.$clean_name.self::SOURCE_CODE_EXT_SEPARATOR.self::SOURCE_CODE_EXT.".php";
            if (file_exists($class_path))
                require_once $class_path;

        } else {
            if ( strpos($class,"\\")) {
                // Found.
                $split = explode('\\',$class);
                //echo "<pre>"; print_r($split); exit;
                //echo __DIR__.DIRECTORY_SEPARATOR.$split[1].".php"; exit;
                if ( array_key_exists(1,$split) && $split[0] != 'StickORM') {
                    require __DIR__.DIRECTORY_SEPARATOR.$split[1].".php";
                }
            }
        }

        // Lets load Middleware
        if ( strpos($class,'Middleware') !== FALSE) {
            $middleware_name = substr($class,0,strpos($class,'Middleware'));
            $class_path = DOCROOT.DS.self::SOURCE_CODE_DIR.DS.self::SOURCE_MIDDLEWARE_DIR.DS.$middleware_name.'.'.self::SOURCE_MIDDLEWARE_EXT.".php";
            if ( file_exists($class_path))
                require $class_path;

        }
    }
}