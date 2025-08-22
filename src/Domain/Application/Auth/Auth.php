<?php

namespace Alpha\Domain\Application\Auth;

require_once __DIR__ . '/../../../../config/config.php';

use Alpha\Domain\Infrastructure\Repository\PdoUserRepository;
use Alpha\Domain\Entity\User;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new PdoUserRepository();
    }

    public function authenticate(string $email, string $password): bool
    {
        $user = $this->pdo->findByEmail($email);
        if ($user != null) {
            $correctPassword = password_verify($password, $user->getPassword() ?? '');
            if ($correctPassword) {
                if (password_needs_rehash($user->getPassword(), PASSWORD_ARGON2ID)) {
                    $this->pdo->changePassword($user, $password);
                }
                $this->setToken($user);
                return $correctPassword;
            }
            return false;
        }
        return false;
    }

    private function setToken(User $user): void
    {
        $payload = [
            'sub' => $user->getId(),
            'email' => $user->getEmail(),
            'exp' => time() + JWT_EXPIRATION
        ];

        $jwt = JWT::encode($payload, JWT_SECRET, 'HS256');

        setcookie('token', $jwt, [
            'expires' => time() + JWT_EXPIRATION,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        ]);
    }

    public static function verifyToken()
    {
        if (!isset($_COOKIE['token'])) {
            header('Location: /login');
        } else {
            try {
                JWT::decode($_COOKIE['token'], new Key(JWT_SECRET, 'HS256'));
            } catch (Exception $e) {
                header('Location: /login');
            }
        }
    }
}