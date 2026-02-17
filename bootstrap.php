<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use App\Helpers\Messages;

//set Base Path
$basePath = match ($_SERVER['HTTP_HOST']) {
    'localhost' => $_ENV['BASE_PATH'],
    default => '',
};

// Setup global language file
Messages::load('nl');

// Setup routing
$request = Request::createFromGlobals();
$routes = require __DIR__ . '/routes/web.php';
$context = new RequestContext();
$context->fromRequest($request);

// Adjust base URL, path info and asset URL for localhost
if (!empty($basePath)) {
    $context->setBaseUrl($basePath) .
        $pathInfo = $context->getPathInfo();
    if (str_starts_with($pathInfo, $basePath)) {
        $context->setPathInfo(substr($pathInfo, strlen($basePath)) ?: '/');
    }
}
$matcher = new UrlMatcher($routes, $context);
$generator = new UrlGenerator($routes, $context);

// Global redirect function
function redirect(string $routeOrUrl, array $parameters = []): RedirectResponse
{
    if (str_starts_with($routeOrUrl, 'http') || str_starts_with($routeOrUrl, 'https')) {
        return new RedirectResponse($routeOrUrl);
    }
    global $generator;
    $url = $generator->generate($routeOrUrl, $parameters);
    return new RedirectResponse($url);
}

// Setup Twig
$loader = new FilesystemLoader(__DIR__ . '/views');
$twig = new Environment($loader, [
    'cache' => false,
    'debug' => true,
    'strict_variables' => false,
]);

// Register custom Twig functions
$twig->addFunction(new TwigFunction('message', function ($key) {
    return $messages[$key] ?? $key;
}));

// Implement asset function
$twig->addFunction(new TwigFunction('asset', function ($path) use ($basePath) {
    return !empty($basePath) ? $basePath . '/public/' . ltrim($path, '/') : '/' . ltrim($path, '/');
}));

// Implement route function
$twig->addFunction(new TwigFunction('route', function ($routeName, $parameters = []) use ($generator) {
    return $generator->generate($routeName, $parameters);
}));

// Clear session messages
$_SESSION['error'] = null;
$_SESSION['success'] = null;
$_SESSION['formErrors'] = null;
$_SESSION['oldInput'] = null;

function executeController(string $controller, Request $request, array $parameters = [])
{
    [$class, $method] = explode('::', $controller);
    $fullClass = 'App\\' . $class;
    $instance = new $fullClass();

    foreach($parameters as $key => $value) {
        $request->attributes->set($key, $value);
    }

    return $instance->$method($request);
}