<?php 

use Alpha\Domain\Application\Controller\Admin\AdminController;
use Alpha\Domain\Application\Controller\Admin\Login\AuthenticateUserController;
use Alpha\Domain\Application\Controller\Admin\Login\LoginController;


return [
    'GET|/login' => LoginController::class,
    'POST|/login' => AuthenticateUserController::class,
    'GET|/admin' => AdminController::class,
];