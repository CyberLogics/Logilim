<?php
/**
 * Created as Entity.php.
 * Developer: Hamza Waqas
 * Date:      2/1/13
 * Time:      4:46 PM
 */

namespace Logilim;
use \Slim\Slim;

class Entity implements IEntity {

    private static  $_plugins = array();

    protected  static function __($needle, $haystack, $default = '') {

        return array_key_exists($needle, $haystack) ? $haystack[$needle] : $default;
    }

    protected static function buildResponse($is_success, $errCode = null, $response = array(), $errDesc = null) {
        $app = Slim::getInstance();
        $app->response()->header('Content-Type','application/json');
        $data['is_success'] = $is_success;
        $data['errCode']    = (!is_null($errCode) ? strval($errCode) : null);
        $data['exception']  = ($errDesc != null ? $errDesc : Errors::errorDescription($errCode)); //Errors::errorDescription($errCode);
        $data['response'] = $response;
        return json_encode($data);
    }


    protected static function post($param = null) {
        $request = Slim::getInstance()->request();
        if ( !is_null($param))
            return $request->post($param);

        return $request->post();
    }


    /**
     *  get values from HTTP body
     * @author  Annum Tahir
     * @version v1.0
     * @return json encoded values|null
     */
    protected static function getBody(){
        return Slim::getInstance()->request()->getBody();
    }



    protected static function get($param = null) {
        $request = Slim::getInstance()->request();
        if ( !is_null($param))
            return $request->get($param);

        return $request->get();
    }

    protected static function request() {
        return Slim::getInstance()->request();
    }

    protected static function params() {
        return Slim::getInstance()->request()->params();
    }


    public static function addPlugin(Plugin $plugin) {
        self::$_plugins[$plugin->getPluginName()] = $plugin;
    }

    public static function addPlugins(array $plugins)
    {
        // TODO: Implement addPlugins() method.
    }

    public static function removePlugin($name) {
        if ( array_key_exists($name,self::$_plugins))
            unset(self::$_plugins[$name]);
    }


    public static function getPlugin($name) {
        return array_key_exists($name, self::$_plugins) ? self::$_plugins[$name] : null;
    }

    public static function getPlugins() {
        return self::$_plugins;
    }

    /**
     *  Checks if plugin exists.
     * @author  Hamza Waqas
     * @version v1.0
     * @param $name
     * @return String|null
     */
   public static function hasPlugin($name) {
           return array_key_exists($name, self::$_plugins) ? self::$_plugins[$name] : null;
    }

   public static function setResponseHeader($key, $val) {
        Slim::getInstance()->response()->header($key, $val);
    }

   public static function getTransactor() {
        return \StickFactory::newTransactor();
    }
}

