<?php

use Alpha\Domain\Application\Auth\Auth;
use Alpha\Domain\Application\Controller\ControllerHandler;
use Alpha\Domain\Application\Controller\Error404Controller;
use Alpha\Domain\Application\Http\Middleware\AuthMiddleware;
use Alpha\Domain\Application\Http\Middleware\MiddlewareDispatcher;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Container\ContainerInterface;

require_once __DIR__ . '/../vendor/autoload.php';
$routes = require_once __DIR__ . '/../config/routes.php';
$publicRoutes = [
    'GET|/admin/login', 
    'POST|/admin/login',
    'GET|/admin/login/forgot-password',
    'POST|/admin/login/forgot-password',
    'POST|/admin/login/admin/login/password-token'
];

/** @var ContainerInterface $diContainer */
$diContainer = require_once __DIR__ . '/../config/dependencies.php';

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory,  // StreamFactory
);

$request = $creator->fromGlobals();

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$key = "$httpMethod|$pathInfo";

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    
    $controller = $diContainer->get($controllerClass);
} else {
    $controller = new Error404Controller();
}

/** @var \Psr\Http\Server\RequestHandlerInterface $controller */

$controllerHandler = new ControllerHandler($controller);

$middlewares = [
    $diContainer->get(AuthMiddleware::class),
];

$protectedDispatcher = new MiddlewareDispatcher(
    [$diContainer->get(AuthMiddleware::class)],
    $controllerHandler
);

$dispatcher = new MiddlewareDispatcher(
    [],
    $controllerHandler
);

$response = in_array($key, $publicRoutes, true) ? $dispatcher->handle($request) : $protectedDispatcher->handle($request);

http_response_code($response->getStatusCode());

foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $response->getBody();
