<?php

namespace Logilim\Plugins;
use Logilim\Plugin;

class RabbitMessagePlugin extends Plugin  {

    public function __construct() {
        $plugin_name = substr(strrchr(get_called_class(),'\\'),1);
        $this->setPluginName($plugin_name);
    }

    public function build( $type, $data = array()) {
        return json_encode(array(
            'type' =>  $type,
            'data' => $data
        ));
    }

}