<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 
// $routes->get('/', 'Students ::index');
// $routes->get('Shop/Product', 'Shop::Product');
// $routes->get('Shop', 'Shop::index');
$routes->get('Admin/Shop', 'Admin\Shop');
$routes->get('/', 'Students::index');
$routes->post('/create', 'Students::create');




$routes->resource('students');
