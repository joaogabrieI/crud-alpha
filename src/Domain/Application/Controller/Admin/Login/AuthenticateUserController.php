<?php

namespace Alpha\Domain\Application\Controller\Admin\Login;


require_once __DIR__ . '/../../../../../../config/config.php';

use Alpha\Domain\Application\Auth\Auth;
use Alpha\Domain\Application\Contracts\MessageHandlerInterface;
use Alpha\Domain\Entity\Repository\UserRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticateUserController implements RequestHandlerInterface
{
    public $pdo;

    public function __construct(private MessageHandlerInterface $messageHandler, private UserRepository $userRepository)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();
        $this->messageHandler->persistInSession();

        $requestBody = $request->getParsedBody();

        $email = filter_var($requestBody['email'], FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            $this->messageHandler->add('Preencha o email corretamente!', MSG_ERROR);
            return new Response(302, [
                'Location' => '/'
            ]);
        }
        $password = filter_var($requestBody['password']);
        if ($password === false) {
            $this->messageHandler->add('Por favor, digite a senha!', MSG_ERROR);
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        $auth = new Auth();


        if ($auth->authenticate($email, $password, $this->userRepository)) {
            $token = $auth->setToken($this->userRepository->findByEmail($email));
            return new Response(302, [
                'Location' => '/admin',
                'Set-Cookie' => "token=$token; HttpOnly; SameSite=Lax; Path=/"
            ]);
        } else {
            $this->messageHandler->add('Credenciais Inválidas!', MSG_ERROR);
            return new Response(302, [
                'Location' => '/admin/login'
            ]);
        }
    }
}