<?php

namespace App\Session;

/**
 * Session object
 */
class Session{

    public static function put($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        return (isset($_SESSION[$key]) ? unserialize($_SESSION[$key]) : null);
    }

    public static function forget($key){
        unset($_SESSION[$key]);
    }
}