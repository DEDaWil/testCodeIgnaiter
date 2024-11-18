<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test', 'TestController::index');
$routes->get('/test/create', 'TestController::create');
$routes->post('/test/store', 'TestController::store');
$routes->get('/test/edit/(:num)', 'TestController::edit/$1');
$routes->post('/test/update/(:num)', 'TestController::update/$1');
$routes->get('/test/delete/(:num)', 'TestController::delete/$1');
$routes->get('/test/downloadXML/(:num)', 'TestController::downloadXML/$1');
