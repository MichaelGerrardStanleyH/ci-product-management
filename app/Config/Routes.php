<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/elektronik', 'Elektronik::index');
$routes->get('/elektronik/create', 'Elektronik::create');
$routes->get('/elektronik/edit/(:num)', 'Elektronik::edit/$1');


$routes->post('/elektronik/save', 'Elektronik::save');
$routes->post('/elektronik/update/(:num)', 'Elektronik::update/$1');
$routes->delete('/elektronik/(:num)', 'Elektronik::delete/$1');

