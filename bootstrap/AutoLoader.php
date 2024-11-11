<?php
declare(strict_types=1);
class Autoloader {
    public static function ClassLoader (string $class) {
        $fqcnToPath = fn(string $fqcn): string => str_replace(search: '\\', replace: '/', subject: $fqcn) . '.php';
        // fully-qualified collection names (FQCN)
        $path = $fqcnToPath(fqcn: $class);
        $filePath = dirname(path: __dir__) . '/app/' . $path;
        if(is_file(filename: $filePath) && is_readable(filename: $filePath)) {
        require_once $filePath;
        }
    }
}

spl_autoload_register(callback: 'AutoLoader::ClassLoader');