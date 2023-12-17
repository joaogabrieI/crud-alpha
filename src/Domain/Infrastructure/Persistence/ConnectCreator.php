<?php

namespace Alpha\Domain\Infrastructure\Persistence;

use PDO;

class ConnectCreator
{
    public static function connect(): PDO
    {
        // $pdo = new PDO("sqlsrv:server=DESKTOP-POF56EJ\SQLEXPRESS; Database = Alpha", "", "");
        $pdo = new PDO('mysql:host=144.22.157.228;dbname=Alpha', 'Alpha' , 'Alpha');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        return $pdo;
    }
}
