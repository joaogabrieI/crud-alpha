<?php

namespace Alpha\Domain\Application;

use Alpha\Domain\Application\Contracts\MessageHandlerInterface;

class MessageHandler implements MessageHandlerInterface
{
    private static $messages = [];

    public function add($message, $type = MSG_INFO): void
    {
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }

        $_SESSION['flash_messages'][] = [
            'type' => $type,
            'text' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
        ];
    }

    public function getMessages(): mixed
    {
        $messages = $_SESSION['flash_messages'] ?? [];
        unset($_SESSION['flash_messages']);
        return $messages;
    }

    public function clear(): void
    {
        self::$messages = [];
    }

    public function persistInSession(): void
    {
        $_SESSION['messages'] = self::$messages;
    }

    public function loadFromSession(): void
    {
        if (!empty($_SESSION['messages'])) {
            self::$messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
        }
    }
}