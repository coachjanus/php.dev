<?php
declare(strict_types=1);

namespace App\Core;

class ClassLoader
{
    // Array to store namespace prefixes and their corresponding base directories.
    protected array $prefixes;

    // Method to register the ClassLoader's autoloader function.
    public function register(): void
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    // Method to add a namespace and its base directory to the ClassLoader.
    public function addNamespace(string $prefix, string $base_dir, bool $prepend = false): void
    {
        // Normalize namespace prefix and base directory.
        // The trim() function removes whitespace and other predefined characters from both sides of a string.
        $prefix = trim($prefix, '\\') . '\\';
        // rtrim() removes whitespace or other predefined characters from the right side of a string.
        $base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

        // Initialize the namespace prefix array if not set.
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = [];
        }

        // Retain the base directory for the namespace prefix.
        if ($prepend) {
            // The array_unshift() function inserts new elements in the beginning to an array.
            array_unshift($this->prefixes[$prefix], $base_dir);
        } else {
            // The array_push() function inserts one or more elements to the end of an array.
            array_push($this->prefixes[$prefix], $base_dir);
        }
    }

    // Private method to load a class using autoloading.
    private function loadClass(string $class): mixed
    {
        // The current namespace prefix.
        $prefix = $class;

        // Iterate through the namespace names to find a mapped file name.
        while (false !== $pos = strrpos($prefix, '\\')) {
            // Retain the trailing namespace separator in the prefix.
            $prefix = substr($class, 0, $pos + 1);

            // The rest is the relative class name.
            $relative_class = substr($class, $pos + 1);

            // Try to load a mapped file for the prefix and relative class.
            $mapped_file = $this->loadMappedFile($prefix, $relative_class);
            if ($mapped_file) {
                return $mapped_file;
            }

            // Remove the trailing namespace separator for the next iteration.
            $prefix = rtrim($prefix, '\\');
        }

        // Class file not found.
        return false;
    }

    // Private method to load a mapped file based on namespace and class name.
    private function loadMappedFile(string $prefix, string $relative_class): mixed
    {
        // Check if there are base directories for this namespace prefix.
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        // Iterate through base directories for this namespace prefix.
        foreach ($this->prefixes[$prefix] as $base_dir) {
             /**
             * Replace the namespace prefix with the base directory,
             * replace namespace separators with directory separators
             * in the relative class name, append with .php
             * */
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

            // If the file is successfully required, return its path.
            if ($this->requireFile($file)) {
                return $file;
            }
        }

        // File not found in any base directory.
        return false;
    }

    // Private method to require a file if it exists.
    private function requireFile(string $file): bool
    {
        // If the file exists, require it and return true.
        if (file_exists($file)) {
            require_once $file;
            return true;
        }

        return false;
    }
}

