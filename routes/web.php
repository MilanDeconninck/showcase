<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

$routes->add('index', (new Route('/'))
    ->setDefaults(['_controller' => 'Controllers\MainController::index']));

// Theme toggle route
$routes->add('theme.switch', (new Route('/theme/{mode}'))
    ->setDefaults(['_controller' => 'Controllers\ThemeController::switch']));

return $routes;
