<?php
namespace Core;

class Session
{
    private static $instance = null;
    private function __construct()
    {
        ini_set("session.use_strict_mode",1);
        ini_set("session.sid_length", 48);
        session_start();
 
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    } 

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }
    public static function clear()
    {
        session_destroy();
    }
    public static function destroy()
    {
        session_unset();
    }
    public static function replace($key, $value)
    {
        $this->remove($key);
        $this->set($key, $value);
    }

}