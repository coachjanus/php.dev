<?php

declare(strict_types=1);

namespace Core\Http;


final class Request
{
    protected array $data = [];

    public function __construct() {
        // $this->data = $_REQUEST;
        $this->data = $this->prepare($_REQUEST, $_FILES);
    }
    private function prepare(array $data, array $files): array
    {
        $data = $this->clean($data);
        return array_merge($data, $files);
    }

    private function clean($data): array|string{
        if(is_array($data)) {
            $cleaned = [];
            foreach($data as $key => $value) {
                $cleaned[$key] = $this->clean($value);
            }
            return $cleaned;
        }
        return trim(htmlspecialchars($data, ENT_QUOTES));
    }

    public function __get(string $name){
        if(isset($this->data[$name]))
        return $this->data[$name] ?? null;

    }

    public function get(string $key, string $default=null): mixed    
    {
        return $this->data[$key] ?? $default;
    }
    public function uri(): string
    {
        return trim(string: parse_url(url: $_SERVER['REQUEST_URI'], component: PHP_URL_PATH), characters: '/');
    }

    public function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ??'GET';
    }
}