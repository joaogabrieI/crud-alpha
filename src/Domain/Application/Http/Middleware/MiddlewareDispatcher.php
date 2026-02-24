<?php

namespace Alpha\Domain\Application\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class MiddlewareDispatcher implements RequestHandlerInterface
{
    private array $middlewares;
    private RequestHandlerInterface $handler;

    public function __construct(array $middlewares, RequestHandlerInterface $handler)
    {
        $this->middlewares = $middlewares;
        $this->handler = $handler;
    } 

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($middleware = array_shift($this->middlewares)) {
            return $middleware->process($request, $this);
        }
        
        return $this->handler->handle($request);
    }

}