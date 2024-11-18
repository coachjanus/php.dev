<?php

$router->get('', 'Controllers\HomeController', 'index');
$router->get('admin', 'Controllers\Admin\Dashboard', 'index');
$router->get('admin/brands', 'Controllers\Admin\BrandController', 'index');
$router->get('admin/brands/create', 'Controllers\Admin\BrandController', 'create');
$router->post('admin/brands/store', 'Controllers\Admin\BrandController', 'store');
$router->get('admin/brands/edit/{id}', 'Controllers\Admin\BrandController', 'edit');
$router->post('admin/brands/update', 'Controllers\Admin\BrandController', 'update');
$router->post('admin/brands/destroy/{id}', 'Controllers\Admin\BrandController', 'destroy');

