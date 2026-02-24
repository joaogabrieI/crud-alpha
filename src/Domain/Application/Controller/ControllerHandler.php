<?php

namespace Alpha\Domain\Application\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ControllerHandler implements RequestHandlerInterface
{
    public function __construct(private RequestHandlerInterface $controller)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->controller->handle($request);
    }
}