<?php

declare(strict_types=1);

namespace Core\Router;

// use Core\Router\Exception\RouteNotFound;
use Core\Http\Request;
final class Router
{
    protected array $routes = [];

    public function __construct(private Request $request)
    {
        $this->request = $request;
    }

    public function add(mixed $method, mixed $uri, mixed $controller, mixed $action): static
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'action' => $action,
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

    public function delete($uri, $controller, $action): Router
    {
        return $this->add(method: 'DELETE', uri: $uri, controller: $controller, action: $action);
    }

    public function patch($uri, $controller, $action): Router
    {
        return $this->add(method: 'PATCH', uri: $uri, controller: $controller, action: $action);
    }

    public function put($uri, $controller, $action): Router
    {
        return $this->add(method: 'PUT', uri: $uri, controller: $controller, action: $action);
    }

    public function only($key): static
    {
        $this->routes[array_key_last(array: $this->routes)]['middleware'] = $key;
        return $this;
    }
   

    public function route($method, $uri): mixed
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper(string: $method)) {
                
                if ($route['uri'] === $uri) {
                    $controller = $route['controller'];
                    $action = $route['action'];
                    return (new $controller($this->request))->$action();
                    
                }else {
                    $pattern ="%^".preg_replace(pattern: '/{([a-zA-Z0-9]+)}/', replacement: '(?<$1>[0-9]+)', subject: $route['uri'])."$%";
                    preg_match(pattern: $pattern, subject: $uri, matches: $matches);

                    array_shift(array: $matches);
                    if ($matches) {
                            $controller = $route['controller'];
                            $action = $route['action'];
                            return (new $controller($this->request))->$action($matches);
                    }
                }
            }

        }

        $this->abort();
    }

    public function previousUrl(): string
    {
        return $_SERVER['HTTP_REFERER'];
    }

    protected function abort($code = 404): never
    {
        http_response_code(response_code: $code);

        // require base_path("views/{$code}.php");

        die();
    }
}
