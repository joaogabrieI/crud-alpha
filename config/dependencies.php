<?php

use Alpha\Domain\Application\Contracts\MessageHandlerInterface;
use Alpha\Domain\Application\Http\Middleware\AuthMiddleware;
use Alpha\Domain\Application\MessageHandler;
use Alpha\Domain\Entity\Repository\UserRepository;
use Alpha\Domain\Infrastructure\Repository\PdoUserRepository;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    PDO::class => function (): PDO {
        $dbPath = __DIR__ . '/../Alpha.sqlite';
        return new PDO("sqlite:$dbPath");
    },
    \League\Plates\Engine::class => function () {
        $templatePath = __DIR__ . '/../views';
        return new League\Plates\Engine($templatePath);
    },
    MessageHandlerInterface::class => function (): MessageHandler {
        return new MessageHandler();
    },
    UserRepository::class => function (): PdoUserRepository {
        $dbPath = __DIR__ . '/../Alpha.sqlite';
        $pdo = new PDO("sqlite:$dbPath");
        return new PdoUserRepository($pdo);
    },
    ResponseFactoryInterface::class => function () {
        return new Psr17Factory();
    }
]);

/** @var \Psr\Container\ContainerInterface $container */
$container = $builder->build();

return $container;