<?php
/**
 * Created as Obligatory.php.
 * Developer: Hamza Waqas
 * Date:      2/2/13
 * Time:      12:35 PM
 */


/**
 *  Works like a value object to handle all necessary mandatory request params for REST
 */
namespace Logilim;

class Obligatory {

    /**
     * @var array Magic Data Storage
     */
    private static $_params = array();

    /**
     * @var array Holds all the Request Data from which it has to be validated
     */
    private $_collection = array();

    private $_isJson = false;


    /**
     * Get New Fresh Factory Instance of Obligatory. Grab lot of instances at once.
     * @return Obligatory
     */

    static function newFactoryInstance() {
        return new Obligatory();
    }

    /**
     *  Set the Param name that needs to be validated and pass it's status either mandatory or not
     * @param $param The name of the param
     * @param bool $is_required TRUE / FALSE
     */
    public function __set($param, $is_required = true) {
        self::$_params[$param] = $is_required;
    }

    /**
     *  Returns the status being set of any param or null
     * @param $param
     * @return null | boolean
     */
    public function __get($param) {
        return array_key_exists($param,self::$_params) ? self::$_params[$param] : null;
    }

    /**
     * Sets Request data to be validated
     * @param array $collection The HTTP Request data from which it has to be validated
     */
    public function setCollection($collection = array()) {

        if($this->_isJson){
            $json_collection = json_decode($collection);
            if(!empty($json_collection)){
                $this->_collection = (array)$json_collection;
            }
        } else {
            if ( !is_array($collection))
                $collection = array();

            $this->_collection = array_merge($this->_collection, $collection);
        }
    }

    /**
     * Get the values set in collection. Helpful when the values format are in json and array values are required.
     * @return _collection
     */

    public function  getCollection(){
        return $this->_collection;
    }

    /**
     *  Check either your params are perfectly matched with HTTP Request Data
     * @return  Exception|Boolean
     * @throws \Exception
     */
    public function validate() {
        $self_params = (self::$_params);
        $filtered = array_filter(array_keys(self::$_params), function($k) use ($self_params) {
            if ( $self_params[$k] == true)
                return true;

            return false;
        });

        $diffs = array_diff($filtered, array_keys($this->_collection));

        $missing_params = array();
        if ( !empty ($diffs)) {
            foreach ($diffs as $diff) {
                $missing_params[] = $diff;
            }

            throw new \Exception("Missing Parameter(s): ".implode(',', $missing_params), Errors::ERR_MISSING_PARAMETERS);
        }

        return true;
    }

    /**
     * Set Flag true for values expected to be in Json Format
     * @return null | boolean
     */
    public function isJson(){
        $this->_isJson = true;
    }

}