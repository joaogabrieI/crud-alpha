<?php

namespace Alpha\Domain\Application\Controller\Admin\Login;

require_once __DIR__ . '/../../../../../../config/config.php';

use Alpha\Domain\Application\Contracts\MessageHandlerInterface;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginController implements RequestHandlerInterface
{
    public function __construct(
        private MessageHandlerInterface $messageHandler,
        private Engine $templates
    ) {
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();

        if (isset($_COOKIE['token'])) {
            return new Response(302, [
                'Location' => '/admin'
            ]);
        }


        $this->messageHandler->loadFromSession();
        $messages = $this->messageHandler->getMessages();

        $data = [
            'messages' => $messages
        ];

        return new Response(200, body: $this->templates->render('login', $data));
    }
}