<?php

namespace Alpha\Domain\Application\Controller\Admin\Login;

require_once __DIR__ . '/../../../../../../config/config.php';

use Alpha\Domain\Application\Contracts\MessageHandlerInterface;
use Alpha\Domain\Application\MessageHandler;
use Alpha\Domain\Application\Controller\Controller;

class LoginController implements Controller
{
    public function __construct(private MessageHandlerInterface $messageHandler) {}
    public function processRequest(): void
    {
        session_start();

        if (isset($_COOKIE['token'])) {
            header('Location: /admin');
        }
        
        $this->messageHandler->loadFromSession();
        $messages = $this->messageHandler->getMessages();

        $data = [
            'messages' => $messages
        ];

        $this->loadView('login', $data);
    }

    private function loadView($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../../../../../../views/{$view}.php";
    }
}