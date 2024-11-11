<?php

declare(strict_types=1);

namespace Core\Http;


final class Request
{
    protected array $data = [];

    public function __construct() {
        $this->data = $_REQUEST;
    }

    // public function __get(string $name){

    // }

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