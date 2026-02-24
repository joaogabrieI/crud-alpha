<?php

namespace Alpha\Domain\Application\Auth;

require_once __DIR__ . '/../../../../config/config.php';

use Alpha\Domain\Entity\Repository\UserRepository;
use Alpha\Domain\Entity\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{

    public function __construct()
    {

    }

    public function authenticate(string $email, string $password, UserRepository $userRepository): bool
    {
        $user = $userRepository->findByEmail($email);
        if ($user != null) {
            $correctPassword = password_verify($password, $user->getPassword() ?? '');
            if ($correctPassword) {
                if (password_needs_rehash($user->getPassword(), PASSWORD_ARGON2ID)) {
                    $userRepository->changePassword($user, $password);
                }
                return $correctPassword;
            }
            return false;
        }
        return false;
    }

    public function setToken(User $user): string
    {
        $payload = [
            'sub' => $user->getId(),
            'email' => $user->getEmail(),
            'exp' => time() + JWT_EXPIRATION
        ];

        return JWT::encode($payload, JWT_SECRET, 'HS256');

        // setcookie('token', $jwt, [
        //     'expires' => time() + JWT_EXPIRATION,
        //     'path' => '/',
        //     'secure' => true,
        //     'httponly' => true,
        //     'samesite' => 'Strict'
        // ]);
    }

    public static function validateToken(?string $token): bool
    {
        if (!$token) {
            return false;
        }

        try {
            JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
            return true;
        } catch (\Throwable) {
            return false;
        }

    }
}