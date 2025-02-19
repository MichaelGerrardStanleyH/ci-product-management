<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/home', 'Home::index');
$routes->get('/electronic', 'Electronic::index');
$routes->get('/electronic/create', 'Electronic::create');
$routes->get('/electronic/edit/(:num)', 'Electronic::edit/$1');

$routes->get('/fashion', 'Fashion::index');
$routes->get('/fashion/create', 'Fashion::create');
$routes->get('/fashion/edit/(:num)', 'Fashion::edit/$1');


$routes->post('/electronic/save', 'Electronic::save');
$routes->post('/electronic/update/(:num)', 'Electronic::update/$1');
$routes->delete('/electronic/(:num)', 'Electronic::delete/$1');

$routes->post('/fashion/save', 'Fashion::save');
$routes->post('/fashion/update/(:num)', 'Fashion::update/$1');
$routes->delete('/fashion/(:num)', 'Fashion::delete/$1');


$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout');
