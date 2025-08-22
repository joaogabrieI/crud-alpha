<?php

namespace Alpha\Domain\Application;

class MessageHandler
{
    private static $messages = [];

    public static function add($message, $type = MSG_INFO)
    {
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }

        $_SESSION['flash_messages'][] = [
            'type' => $type,
            'text' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
        ];
    }

    public static function getMessages()
    {
        $messages = $_SESSION['flash_messages'] ?? [];
        unset($_SESSION['flash_messages']);
        return $messages;
    }

    public static function clear()
    {
        self::$messages = [];
    }

    public static function persistInSession()
    {
        $_SESSION['messages'] = self::$messages;
    }

    public static function loadFromSession()
    {
        if (!empty($_SESSION['messages'])) {
            self::$messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
        }
    }
}