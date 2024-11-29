<?php
declare(strict_types=1);

namespace Core;

use Core\Http\{Request, Response};
use Core\Router\Router;

final class Kernel
{
    public function __construct(private string $enviroment)
    {
        $this->enviroment = $enviroment;
        \error_reporting(error_level: 0);
        if($enviroment === 'dev') {
            \error_reporting(error_level: E_ALL);
            \ini_set(option: 'display_errors',value: '1');
        }
        $this->boot();

    }
    private function boot(): void
    {
        date_default_timezone_set(timezoneId: getenv(name: 'APP_TIMEZONE') ?? 'UTC');
        Session::getInstance();
    }

    public function handler(Request $request): Response
    {
        
        $router = new Router($request);
        require_once dirname(path: __DIR__, levels: 2)."/config/routes.php";
       
        $content = $router->route(uri: $request->uri(), method: $request->method());

        $response = new Response(body: $content);
        return $response;
    }

    public static function projectDir(): string
    {
        return dirname(path: __DIR__, levels:2);
    }
}