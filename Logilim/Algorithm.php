<?php
/**
 * Created as Algorithm.php.
 * Developer: Hamza Waqas
 * Date:      9/5/13
 * Time:      4:40 PM
 */

namespace Logilim;


class Algorithm {

    /**
     *  Generates a blowfish password with x round robins.
     * @param $password
     * @param int $round
     * @return string
     * @throws ErrorException
     */
    static function blowFishRobin($password, $round = 7) {
        $salt = "";
        $chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
        for($i=0; $i < 22; $i++) {
            $salt .= $chars[array_rand($chars)];
        }

        if ( !function_exists('crypt'))
            throw new ErrorException('crypt() function not found on server.');
        return crypt($password, sprintf('$2a$%02d$', $round) . $salt);
    }

    /**
     *  Match for encrypted password
     * @param $plain
     * @param $blowfish
     * @return bool
     */
    static function matchPassword($plain, $blowfish) {
        return ($blowfish === crypt($plain, $blowfish));
    }
}