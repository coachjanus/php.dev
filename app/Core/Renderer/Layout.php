<?php declare(strict_types=1);

namespace Core\Renderer;

use Exception;

final class Layout
{
    private static ?Layout $instance = null;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance($path, $layout): Layout
    {
        if (self::$instance === null) {
            ob_start();
            self::$instance = new self();
            require_once "{$path}/layouts/{$layout}.php";
        }

        return self::$instance;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {
    }

    /**
     * prevent the instance from being cloned (which would create a second instance of it)
     */
    private function __clone()
    {
    }

    /**
     * prevent from being unserialized (which would create a second instance of it)
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}
