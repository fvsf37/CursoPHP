<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Config\BaseConfig;

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes = Services::routes();

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Cargar el sistema de rutas predeterminado de CodeIgniter
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Custom Routes
 * --------------------------------------------------------------------
 */

// Ruta predeterminada que apunta a Calculator::index
$routes->get('/', 'Calculator::index');

// Ruta para manejar el formulario de cálculo
$routes->post('calculator/calculate', 'Calculator::calculate');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 * Aquí puedes cargar archivos de rutas adicionales basados en el
 * entorno actual. Simplemente debes usar `require_once`.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
