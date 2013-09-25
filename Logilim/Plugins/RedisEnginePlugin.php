<?php
/**
 * Created as RedisEnginePlugin.php.
 * Developer: Hamza Waqas
 * Date:      6/27/13
 * Time:      11:17 AM
 */

namespace Logilim\Plugins;

use Logilim\Plugin;

class RedisEnginePlugin extends Plugin {

    private $_redis = null;

    private $_data = null;

    private $_userId = null;

    private $_md5Id = null;

    const KEY_TOKEN = 'token';

    const KEY_LAST_LOGIN = 'logged_in_at';

    const KEY_lAST_REFRESH = 'refresh_at';

    const EXPIRE_SESSION_AT = 3500;

    public function __construct() {
        global $redis;
        $this->preparePlugin();
        $this->_redis = $redis;
    }

    public function __get($arg) {
        return $this->_data[$arg];
    }

    public function __set($arg, $val) {
        $this->_data[$arg] = $val;
    }

    /**
     * @param $user_id
     * @return $this
     */
    public function prepareToken($user_id) {
        $time = microtime(true);
        $raw = md5($time.uniqid());
        $this->_userId = $user_id;
        $this->_data['token'] = '"\\'.strrev($raw).'\\'.$user_id.'\\'.$time.'/"';   // \md5()\user_id\created_on/
        return $this;
    }

    public function saveFor() {

        if( null === $this->_md5Id )
            $this->_md5Id = md5($this->_userId);

        list($key,$logged_in_at, $last_refresh) = array(
            $this->_md5Id ,time(),time()
        );
        $this->_redis->hmset($key,self::KEY_TOKEN,$this->_data['token'], self::KEY_LAST_LOGIN, $logged_in_at, self::KEY_lAST_REFRESH,$last_refresh);
        $this->_redis->expire($key, self::EXPIRE_SESSION_AT);
        return $this;
    }

    public function getFor($id) {
     //   if(empty($this->_md5Id))
     //       $this->_md5Id = md5($id);
        return $this->_redis->hgetAll(md5($id));
    }

    public function refreshFor($token) {
        if (!isset($token))
                throw new \Exception('argument missing in refreshFor()');

        $id = ($this->_getIdOutOfToken($token['old_token']));
        if($this->exist($token['old_token'])){
            //$md5_id = md5($id);
            $this->_redis->hmset($this->_md5Id,self::KEY_TOKEN,$this->prepareToken($id)->token, self::KEY_lAST_REFRESH, time());
            $this->_redis->expire($this->_md5Id,self::EXPIRE_SESSION_AT);
        }else{
            $this->prepareToken($id)->saveFor()->token;
        }
        return $this;
    }

    public function exist($token) {
        $id = $this->_getIdOutOfToken($token);
        $this->_md5Id = md5($id);
        $ttl = $this->_redis->ttl($this->_md5Id);
        if ( $ttl <= 0) {
            $object = $this->_redis->hmget($this->_md5Id, 'token');

            if($object == $token)
                return true;

            return false;
        } else {
            return true;
        }
    }

    private function _getIdOutOfToken($token) {
        $user_id = null;
        $user_id = str_replace('"','',$token);
        $user_id = substr($token,strlen(substr($token,0,35)));
        $user_id =  substr($user_id,0,stripos($user_id,'\\'));
        return $user_id;
    }

    public function reset() {
        $this->_data = array();
        return $this;
    }

}