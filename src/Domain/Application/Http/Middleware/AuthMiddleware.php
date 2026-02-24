<?php

namespace Alpha\Domain\Application\Http\Middleware;

use Alpha\Domain\Application\Auth\Auth;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(
        private Auth $auth,
        private ResponseFactoryInterface $responseFactory
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface 
    {
        $token = $request->getCookieParams()['token'] ?? null;

        if (!$this->auth->validateToken($token)) {
            return $this->responseFactory->createResponse(302)->withHeader('Location', '/admin/login');
        }

        return $handler->handle($request);
    }
}