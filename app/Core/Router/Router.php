<?php
declare(strict_types=1);

namespace Core\Router;

use Core\Http\Request;

final class Router
{
    private $routes = [];
    public function __construct(private Request $request)
    {
        $this->request = $request;
    }

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
    public function post($uri, $controller, $action): Router
    {
        return $this->add(method: 'POST', uri: $uri, controller: $controller, action: $action);
    }

    public function route($uri, $method): mixed
    {
 
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper(string: $method) && $route['uri'] === $uri) {
                    $controller = $route['controller'];
                    $action = $route['action'];
                    return (new $controller($this->request))->$action();
            }
            
        }
        $this->abort();
    }
    protected function abort($code = 404): void
    {
        http_response_code(response_code: $code);
        exit($code);
    }
}

