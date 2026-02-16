<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    'controller' => 'App\Controllers\MainController',
    'method' => 'index'
]));

return $routes;