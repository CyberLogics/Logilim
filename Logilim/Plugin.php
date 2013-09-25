<?php
/**
 * Created as Plugin.php.
 * Developer: Hamza Waqas
 * Date:      2/26/13
 * Time:      1:37 PM
 */
namespace Logilim;
/**
 * @author      Hamza Waqas
 * @since       1 Feb, 2013
 */
abstract class Plugin implements IPlugin {

    protected $_name = "";

    public function setPluginName($name) {
        $this->_name = $name;
    }

    public function getPluginName() {
        return $this->_name;
    }

    /**
     *  Method to register internal plugin properties.
     *  Encouraged to use in __construct()
     */
    public function preparePlugin() {
        $this->setPluginName(join('', array_slice(explode('\\', get_called_class()), -1)));
    }
}
