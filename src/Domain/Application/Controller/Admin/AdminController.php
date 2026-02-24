<?php 

namespace Alpha\Domain\Application\Controller\Admin;

use Alpha\Domain\Application\Controller\Controller;
use Alpha\Domain\Application\Controller\ViewController;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminController implements RequestHandlerInterface
{
    public function __construct(private Engine $templates){

    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(200, body: $this->templates->render('admin'));
    }
}