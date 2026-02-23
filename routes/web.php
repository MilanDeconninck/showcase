<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

// Home page route
$routes->add('index', (new Route('/'))
    ->setDefaults(['_controller' => 'Controllers\MainController::index']));

// Theme toggle route
$routes->add('theme.switch', (new Route('/theme/switch'))
    ->setDefaults(['_controller' => 'Controllers\ThemeController::switch'])
    ->setMethods(['POST']));

// Portfolio page route    
$routes->add('portfolio', (new Route('/portfolio'))
    ->setDefaults(['_controller' => 'Controllers\PortfolioController::index']));

return $routes;
