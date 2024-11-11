<?php
declare(strict_types=1);

require_once "AutoLoader.php";

function uri() {
    return $_SERVER['REQUEST_URI'];
}

function render($view, $context = []) {
    ob_start();
    $content = template($view, $context);
    $layout = dirname(__DIR__)."/views/layouts/app.php";
    require_once($layout);
    return str_replace("{{ content }}", $content, ob_get_clean());
}
function template($view, $context) {
    $file = dirname(__DIR__)."/views/$view.php";
    ob_start();
    extract($context);
    include($file);
    return ob_get_clean();
}

// require_once dirname(__DIR__)."/app/Core/DotEnv.php";

use Core\DotEnv;
// use Core\Http\Request;
// use Core\Http\Response;
use Core\Http\{Request, Response};

// (new Core\DotEnv(dirname(__DIR__)."/.env"))->load();

(new DotEnv(filename: dirname(__DIR__)."/.env"))->load();

// var_dump(value: $_ENV);
use Core\Kernel;

$kernel = new Kernel(enviroment: getenv(name: 'APP_ENV'));
$request = new Request();
$response = $kernel->handler(request: $request);
$response->send();


// $routes = require_once dirname(__DIR__)."/config/routes.php";

// $request = trim(uri(), '/');

// if (array_key_exists($request, $routes)) {
//     require_once dirname(__DIR__)."/app/Controllers/$routes[$request].php";
//     $controller = new $routes[$request]();
//     $controller->index();
// } else {
//     require_once dirname(__DIR__)."/app/Controllers/ErrorController.php";
//     new ErrorController();
// }

