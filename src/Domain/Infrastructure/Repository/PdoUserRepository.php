<?php

namespace Alpha\Domain\Infrastructure\Repository;

use Alpha\Domain\Infrastructure\Persistence\ConnectCreator;
use Alpha\Domain\Model\Repository\AdminRepository;
use Alpha\Domain\Model\User;
use stdClass;
use PDO;

class PdoUserRepository implements AdminRepository
{
    private $connection;
    public function __construct()
    {
        $this->connection = ConnectCreator::connect();
    }
    public function listAll() : array
    {
        $query = "SELECT * FROM ADMINISTRADOR";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        $users = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $users[] = new User($row['ADM_ID'], $row['ADM_NOME'], $row['ADM_EMAIL'], $row['ADM_SENHA'], $row['ADM_ATIVO']);
        }

        return $users;
    }

    public function findById(int $id)
    {
        $query = "SELECT * FROM ADMINISTRADOR WHERE ADM_ID = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row){
            return new User($row['ADM_ID'], $row['ADM_NOME'], $row['ADM_EMAIL'], $row['ADM_SENHA'], $row['ADM_ATIVO']);
        }

        return null;
    }

    public function save(stdClass $object) : bool
    {
        return true;
    }

    public function remove(stdClass $objct) : bool
    {
        return true;
    }
}