<?php
namespace Core\Database;

use PDO;
use Core\Kernel;
class Connection
{
    protected static $instance = null;
    protected static $config = [];
    public static function make(): PDO {
        self::$config = require_once Kernel::projectDir().'/config/db.php';
        if(!self::$instance) {
            $dsn = self::makeDsn(self::$config['database']);
            self::$instance = new PDO(
                $dsn, 
                self::$config['user'],
                self::$config['password'],
                self::$config['options']
            );
        }
        return self::$instance;
    }

    private static function makeDsn($config): string 
    {
        $dsn = $config['driver'].':';
        unset($config['driver']);
        foreach ($config as $key => $value) {
            $dsn .= $key.'='.$value.';';
        }
        return substr($dsn, 0, -1);
    }
}