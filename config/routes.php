<?php 

use Alpha\Domain\Application\Controller\Admin\AdminController;
use Alpha\Domain\Application\Controller\Admin\Login\AuthenticateUserController;
use Alpha\Domain\Application\Controller\Admin\Login\LoginController;


return [
    'GET|/admin/login' => LoginController::class,
    'POST|/admin/login' => AuthenticateUserController::class,
    'GET|/admin' => AdminController::class,
];