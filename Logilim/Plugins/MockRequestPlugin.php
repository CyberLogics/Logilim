<?php

namespace Logilim\Plugins;
use Logilim\Plugin;

/**
 *  Handles to make HTTP request.
 * Class MockRequestPlugin
 * @package Logilim\Plugins
 * @author  Hamza Waqas
 * @version v1.0
 *
 */
class MockRequestPlugin extends Plugin {

    public function __construct() {
        $this->preparePlugin();
    }

    /**
     * @param string $method
     * @param $url
     * @param bool $back_return IF TRUE, then will return response
     * @return mixed
     */
    public function fire($method = "GET",$url, $back_return = false) {

        if ( !isset($url))
            throw new \Exception("URL argument is missing in ".__METHOD__);

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,   FALSE);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
        $response = curl_exec($ch);
        if ( $back_return)
            return $response;

        return;
    }

    public function fireTask($taskName = null, $args = null, $back_return = false) {

        if (is_null($taskName))
            throw new \Exception("Task name is required to execute in ".__METHOD__);

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,'http://'.$_SERVER['HTTP_HOST'].'/task/'.$taskName.$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,   FALSE);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"TASK");
        $response = curl_exec($ch);
        curl_close($ch);

    }
}