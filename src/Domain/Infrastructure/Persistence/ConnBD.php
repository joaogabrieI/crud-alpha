<?php

namespace Alpha\Domain\Infrastructure\Persistence;

use PDO;

class ConnDB
{
    public static function connect(): PDO
    {
        $pdo = new PDO("sqlsrv:server=DESKTOP-POF56EJ\SQLEXPRESS; Database = Alpha", "", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        return $pdo;
    }
}
