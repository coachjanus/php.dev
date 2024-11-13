<?php

$router->get('', 'Controllers\HomeController', 'index');
$router->get('admin', 'Controllers\Admin\Dashboard', 'index');
