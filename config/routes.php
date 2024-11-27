<?php

$router->get('', 'Controllers\HomeController', 'index');
$router->get('register', 'Controllers\RegisterController', 'index');
$router->post('signon', 'Controllers\RegisterController', 'register');
$router->get('login', 'Controllers\LoginController', 'login');
$router->post('signin', 'Controllers\LoginController', 'signin');
$router->get('admin', 'Controllers\Admin\Dashboard', 'index');
$router->get('admin/brands', 'Controllers\Admin\BrandController', 'index');
$router->get('admin/brands/create', 'Controllers\Admin\BrandController', 'create');
$router->post('admin/brands/store', 'Controllers\Admin\BrandController', 'store');
$router->get('admin/brands/edit/{id}', 'Controllers\Admin\BrandController', 'edit');
$router->post('admin/brands/update', 'Controllers\Admin\BrandController', 'update');
$router->post('admin/brands/destroy/{id}', 'Controllers\Admin\BrandController', 'destroy');



$router->get('admin/sections', 'Controllers\Admin\SectionController', 'index');
$router->get('admin/sections/create', 'Controllers\Admin\SectionController', 'create');
$router->post('admin/sections/store', 'Controllers\Admin\SectionController', 'store');
$router->get('admin/sections/edit/{id}', 'Controllers\Admin\SectionController', 'edit');
$router->post('admin/sections/update', 'Controllers\Admin\SectionController', 'update');
$router->post('admin/sections/destroy/{id}', 'Controllers\Admin\SectionController', 'destroy');

$router->get('admin/categories', 'Controllers\Admin\CategoryController', 'index');

$router->get('admin/categories/create', 'Controllers\Admin\CategoryController', 'create');

$router->post('admin/categories/store', 'Controllers\Admin\CategoryController', 'store');

$router->get('admin/categories/edit/{id}', 'Controllers\Admin\CategoryController', 'edit');

$router->post('admin/categories/update', 'Controllers\Admin\CategoryController', 'update');


$router->get('admin/roles', 'Controllers\Admin\RoleController', 'index');

$router->get('admin/roles/create', 'Controllers\Admin\RoleController', 'create');

$router->post('admin/roles/store', 'Controllers\Admin\RoleController', 'store');

$router->get('admin/roles/edit/{id}', 'Controllers\Admin\RoleController', 'edit');

$router->post('admin/roles/update', 'Controllers\Admin\RoleController', 'update');