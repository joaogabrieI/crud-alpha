<?php

namespace Alpha\Domain\Application\Controller\Admin\Login;


require_once __DIR__ . '/../../../../../../config/config.php';

use Alpha\Domain\Application\Auth\Auth;
use Alpha\Domain\Application\Controller\Controller;
use Alpha\Domain\Application\MessageHandler;

class AuthenticateUserController implements Controller
{
    public $pdo;
    public function processRequest(): void
    {
        session_start();
        MessageHandler::persistInSession();
        
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            header('Location: /admin/login');
            MessageHandler::add('O campo email é obrigatório!', MSG_ERROR);
        }
        $password = filter_input(INPUT_POST, 'password');
        if ($password === false) {
            header('Location: /admin/login');
            MessageHandler::add('Por favor, digite a senha!', MSG_ERROR);
        }

        $auth = new Auth();
        
        if ($auth->authenticate($email, $password)) {
            header('Location: /admin');
        } else {
            MessageHandler::add('Credenciais Inválidas!', MSG_ERROR);
            header('Location: /admin/login');
        }
    }
}