<?php
/**
 * Created as LogilimUnit_TestCase.php.
 * Developer: Hamza Waqas
 * Date:      5/20/13
 * Time:      2:17 PM
 */
namespace Logilim;
class LogilimUnit_TestCase extends PHPUnit_Framework_TestCase {

    public function __construct() {
        parent::__construct();
        echo DOCROOT; exit;
        \Logilim\Autoloader::registrar();
    }
}