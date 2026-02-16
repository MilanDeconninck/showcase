<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Load routes
$routes = require_once __DIR__ . '/routes/web.php';

// Setup Twig
$loader = new FilesystemLoader(__DIR__ . '/views');
$twig = new Environment($loader, [
    'cache' => false,
    'debug' => true,
    'strict_variables' => false,
]);

// Register custom Twig functions
$twig->addFunction(new \Twig\TwigFunction('message', function ($key) {
    $messages = require __DIR__ . '/languages/nl/messages.php';
    return $messages[$key] ?? $key;
}));

$twig->addFunction(new \Twig\TwigFunction('asset', function ($path) {
    return '/' . $path;
}));

return [
    'routes' => $routes,
    'twig' => $twig
];