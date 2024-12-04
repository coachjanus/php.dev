<?php
// app/Core/Http/Request.php
declare(strict_types=1);

namespace Core\Http;

final class Request
{
    /**
     * The request data.
     *
     * @var array
     */
    protected array $data;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        // $this->data = $_REQUEST;
        $this->data = $this->prepare($_REQUEST, $_FILES);

    }

    private function prepare(array $request, array $files)
    {
        $request = $this->clean($request);
        return array_merge($files, $request);
    }

    private function clean($data)
    {
        if (is_array($data)) {
            $cleaned = [];
            foreach($data as $key => $value) {
                $cleaned[$key] = $this->clean($value);
            }
            return $cleaned;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }


    /**
     * Get parameter from the global request array.
     *
     * @param string      $key
     * @param string|null $default
     *
     * @return mixed|null
     */
    public function get(string $key, string $default = null): mixed
    {
        return $this->data[$key] ?? $default;
    }

    public function __get($name)
    {
        if(isset($this->data[$name])) {
            return $this->data[$name];
        }
    }

    /**
     * Fetch the request URI.
     *
     * @return string
     */
    public static function uri(): string
    {
        return trim(
            string: parse_url(url: $_SERVER['REQUEST_URI'], component: PHP_URL_PATH), characters: '/'
        );
    }

    /**
     * Fetch the request method.
     *
     * @return string
     */
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
}
