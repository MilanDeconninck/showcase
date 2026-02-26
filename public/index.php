<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';

use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Response;

try {
    // Calls router
    $parameters = $matcher->match($request->getPathInfo());
    $route = $parameters['_route'];
    $controller = $parameters['_controller'];

    unset($parameters['_route'], $parameters['_controller']);

    if ($controller) {
        $parameters = executeController($controller, $request, $parameters ?? []);
    }

    if ($parameters instanceof Response) {
        $response = $parameters;
    } else {
        $content = $twig->render($route . '.twig', $parameters);
        $response = new Response($content);
    }

    // Catch Exceptions
} catch (ResourceNotFoundException $e) {
    $content = $twig->render('status.twig', ['code' => 404]);
    $response = new Response($content, 404);
} catch (Throwable $e) {
    $content = $twig->render('status.twig', ['code' => 500]);
    $response = new Response($content, 500);
}

$response->send();