<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //Home - Inicio
$routes->get('/', 'Home::index');
$routes->get('/inicio', 'Home::index');
$routes->get('/yo', 'Home::sobre_mi');


 //Formularios
 $routes->get('/formularios/edad', 'formularios\Basicos::formulario_edad');
 $routes->post('/formularios/edad', 'formularios\Basicos::calculo_edad');
 $routes->get('/formularios/calculadora', 'formularios\Basicos::calculadora');
 $routes->post('/formularios/calculadora', 'formularios\Basicos::calculadora');