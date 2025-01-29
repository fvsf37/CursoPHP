<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/producto', 'Producto::index');
$routes->get('/producto/create', 'Producto::create');
$routes->post('/producto/store', 'Producto::store');
$routes->get('/producto/edit/(:num)', 'Producto::edit/$1');
$routes->post('/producto/update/(:num)', 'Producto::update/$1');
$routes->get('/producto/delete/(:num)', 'Producto::delete/$1');

