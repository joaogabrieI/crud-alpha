<?php

namespace Alpha\Domain\Infrastructure\Persistence;

use PDO;
use PDOException;

class ConnectCreator
{
    public static function connect(): PDO
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=alpha', 'root', 'admin');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
            return $pdo;
        } catch (PDOException $e) {
            echo "erro na conexao" . $e->getMessage();
            die();
        }
    }
}
