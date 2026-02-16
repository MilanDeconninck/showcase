<?php

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$bootstrap = require_once __DIR__ . '/../bootstrap.php';
$routes = $bootstrap['routes'];
$twig = $bootstrap['twig'];

$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($request->getPathInfo());

    $controllerClass = $parameters['controller'];
    $method = $parameters['method'];

    // Instantiate controller with Twig
    $controller = new $controllerClass($twig);

    // Call the controller method
    $content = $controller->$method();

    $response = new Response($content, 200);
    $response->send();

} catch (ResourceNotFoundException $e) {
    $response = new Response('Page Not Found', 404);
    $response->send();
} catch (\Exception $e) {
    $response = new Response('Internal Server Error: ' . $e->getMessage(), 500);
    $response->send();
}