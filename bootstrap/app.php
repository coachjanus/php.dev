<?php declare(strict_types=1);

require_once "AutoLoader.php";

use Core\DotEnv;
use Core\Http\{Request, Response};
use Core\Kernel;

(new DotEnv(filename: dirname(__DIR__)."/.env"))->load();

$kernel = new Kernel(enviroment: getenv(name: 'APP_ENV'));
$request = new Request();
$response = $kernel->handler(request: $request);
$response->send();
