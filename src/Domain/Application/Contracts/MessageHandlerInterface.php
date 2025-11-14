<?php

namespace Alpha\Domain\Application\Contracts;

interface MessageHandlerInterface
{
    public function add($message, $type = MSG_INFO): void;
    public function getMessages(): mixed;
    public function clear(): void;
    public function persistInSession(): void;
    public static function loadFromSession(): void;
}