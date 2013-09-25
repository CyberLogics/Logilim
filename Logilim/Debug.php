<?php
/**
 * Created as Debug.php.
 * Developer: Hamza Waqas
 * Date:      2/6/13
 * Time:      6:21 PM
 */

namespace Logilim;

class Debug {

    static function vars(&$variables) {
        echo "<pre>"; print_r($variables); echo "</pre>";
    }
}