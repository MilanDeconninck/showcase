<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

$routes->add('index', (new Route('/'))
    ->setDefaults(['_controller' => 'Controllers\MainController::index']));

return $routes;