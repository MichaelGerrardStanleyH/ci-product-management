<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->get('/home', 'Home::index', ['filter' => 'auth']);
$routes->get('/electronic', 'Electronic::index', ['filter' => 'auth']);
$routes->get('/electronic/create', 'Electronic::create', ['filter' => 'auth']);
$routes->get('/electronic/edit/(:num)', 'Electronic::edit/$1', ['filter' => 'auth']);

$routes->get('/fashion', 'Fashion::index', ['filter' => 'auth']);
$routes->get('/fashion/create', 'Fashion::create', ['filter' => 'auth']);
$routes->get('/fashion/edit/(:num)', 'Fashion::edit/$1', ['filter' => 'auth']);


$routes->post('/electronic/save', 'Electronic::save', ['filter' => 'auth']);
$routes->post('/electronic/update/(:num)', 'Electronic::update/$1', ['filter' => 'auth']);
$routes->delete('/electronic/(:num)', 'Electronic::delete/$1', ['filter' => 'auth']);

$routes->post('/fashion/save', 'Fashion::save', ['filter' => 'auth']);
$routes->post('/fashion/update/(:num)', 'Fashion::update/$1', ['filter' => 'auth']);
$routes->delete('/fashion/(:num)', 'Fashion::delete/$1', ['filter' => 'auth']);


$routes->post('/auth/login', 'Auth::login');
$routes->get('/auth/logout', 'Auth::logout', ['filter' => 'auth']);
