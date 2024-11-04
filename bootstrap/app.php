<?php

// echo __DIR__;

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
switch (uri()) {
    case '/':
        require_once dirname(__DIR__)."/app/Controllers/HomeController.php";
        break;
    case '/about':
        require_once dirname(__DIR__)."/app/Controllers/AboutController.php";
        break;
    case '/contact':
        echo "<h1>Contact Page</h1>";
        break;
}
