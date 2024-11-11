<?php
declare(strict_types=1);

namespace Core\Router;

final class Router
{
    private $routes = [];

    public function add($method, $uri, $controller, $action): static
    {
        $this->routes[] = [
            'method'=>$method,
            'uri'=>$uri, 
            'controller'=>$controller,
            'action'=>$action
            ];
        return $this;
    }
    public function get($uri, $controller, $action): Router
    {
        return $this->add(method: 'GET', uri: $uri, controller: $controller, action: $action);

    }

    public function route($uri, $method): mixed
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper(string: $method)) {
                if ($route['uri'] === $uri) {
                    $controller = $route['controller'];
                    $action = $route['action'];
                    return (new $controller())->$action();
                }
            }
            $this->abort();
        }
    }
    protected function abort($code = 404): void
    {
        http_response_code(response_code: $code);
        exit($code);
    }
}

