<?php
declare(strict_types=1);

namespace App\Core;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Exception;

final class AppLoader
{
    // Array to store directories to search for classes.
    protected $directories;

    // Method to add a directory to the AppLoader.
    public function addDirectory($directory)
    {
        $this->directories[] = $directory;
    }

    // Method to register the AppLoader's autoloader function.
    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
        // var_dump($this->directories);
    }

    // Method to load a class using autoloading based on registered directories.
    public function loadClass($class)
    {
        // Get the directories to search for the class.
        $folders = $this->directories;
        // var_dump($this->directories);

        // Iterate through the registered directories.
        foreach ($folders as $folder) {
            // Check if the class file exists directly in the current directory.
            if (file_exists("{$folder}/{$class}.php")) {
                require_once "{$folder}/{$class}.php";
                return true;
            } else {
                // If the directory itself exists, search for the class file recursively.
                if (file_exists($folder)) {
                    // Iterate through files and subdirectories in the current directory.
                    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder),
                             RecursiveIteratorIterator::SELF_FIRST) as $entry) {
                        // Check if the entry is a directory.
                        
                        if (is_dir($entry->getFilename())) {
                            var_export($entry->getFilename());
                            // Check if the class file exists in the current subdirectory.
                            if (file_exists("{$entry->getFilename()}/{$class}.php")) {
                                require_once "{$entry->getFilename()}/{$class}.php";
                                return true;
                            }
                        }
                    }
                }
            }
        }

        // Class file not found in any registered directory.
        return false;
    }
}
