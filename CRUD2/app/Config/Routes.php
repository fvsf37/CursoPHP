<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Productos');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Ruta principal para listar productos
$routes->get('/', 'Productos::index');

// Rutas CRUD para productos
$routes->get('productos', 'Productos::index');
$routes->get('productos/agregar', 'Productos::agregar');
$routes->post('productos/agregar', 'Productos::agregar');
$routes->get('productos/editar/(:num)', 'Productos::editar/$1');
$routes->post('productos/editar/(:num)', 'Productos::editar/$1');
$routes->get('productos/eliminar/(:num)', 'Productos::eliminar/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There are additional routing files based on the environment.
 * You can require() them here to make that happen.
 * You will have access to the $routes object within that file.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
