<?php

use Alpha\Domain\Application\Auth\Auth;
use Alpha\Domain\Application\Controller\Error404Controller;

require_once __DIR__ . '/../vendor/autoload.php';
$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];
$auth = new Auth();

$key = "$httpMethod|$pathInfo";

$isLoginRoute = $pathInfo === '/login';
if (!$isLoginRoute) {
    Auth::verifyToken();
}

if (array_key_exists($key, $routes)) {
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    $controller = new $controllerClass();
} else {
    $controller = new Error404Controller();
}
$controller->processRequest();

