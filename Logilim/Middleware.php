<?php
/**
 * Created as Middleware.php.
 * Developer: Hamza Waqas
 * Date:      6/25/13
 * Time:      5:06 PM
 */

namespace Logilim;

abstract class Middleware extends \Slim\Middleware {

    public function buildResponse($is_success = 1, $errCode = null, $response = array()) {
        $data['is_success'] = $is_success;
        $data['errorCode']  = (is_null($errCode) ? '' : strval($errCode));
        $data['exception']  = Errors::errorDescription($errCode);
        $data['response'] = $response;
        return json_encode($data);
    }


}