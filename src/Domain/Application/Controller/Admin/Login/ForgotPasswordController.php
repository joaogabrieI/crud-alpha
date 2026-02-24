<?php

namespace Alpha\Domain\Application\Controller\Admin\Login;

use Alpha\Domain\Application\Contracts\MessageHandlerInterface;
use Alpha\Domain\Application\Controller\ViewController;
use Alpha\Domain\Application\Services\MailService;
use Alpha\Domain\Application\Services\ResetPasswordTokenService;
use Alpha\Domain\Entity\Repository\UserRepository;
use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ForgotPasswordController implements RequestHandlerInterface
{
    use ViewController;

    public function __construct(
        private MessageHandlerInterface $messageHandler,
        private UserRepository $userRepository,
        private Engine $templates
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_start();
        $this->messageHandler->persistInSession();

        $requestBody = $request->getParsedBody();

        if (isset($_COOKIE['token'])) {
            header('Location: /admin');
        }

        $email = filter_var($requestBody['email'], FILTER_VALIDATE_EMAIL) ?? '';

        if ($email === false) {
            $this->messageHandler->add('Preencha o email corretamente!', MSG_ERROR);
            return new Response(302, [
                'Location' => '/'
            ]);
        }

        if ($user = $this->userRepository->findByEmail($email)) {
            $token = ResetPasswordTokenService::generateToken($user);
            MailService::sendEmail($user, $token);
            return new Response(200, body: $this->templates->render('verify_code_form'));
        }

        $messages = $this->messageHandler->getMessages();

        $data = [
            'messages' => $messages
        ];

        return new Response(200, body: $this->templates->render('forgot_password_form', $data));
    }
}