<?php

namespace Alpha\Domain\Infrastructure\Repository;

use Alpha\Domain\Infrastructure\Persistence\ConnectCreator;
use Alpha\Domain\Model\Repository\UserRepository;
use Alpha\Domain\Model\User;
use PDO;
use PDOException;

class PdoUserRepository implements UserRepository
{
    private $connection;
    public function __construct()
    {
        $this->connection = ConnectCreator::connect();
    }
    public function listAll(): array
    {
        $query = "SELECT * FROM administrador";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        $users = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($row['ADM_ID'], $row['ADM_NOME'], $row['ADM_EMAIL'], $row['ADM_SENHA'], $row['ADM_ATIVO']);
        }

        return $users;
    }

    public function findById(int $id)
    {
        $query = "SELECT * FROM administrador WHERE ADM_ID = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['ADM_ID'], $row['ADM_NOME'], $row['ADM_EMAIL'], $row['ADM_SENHA'], $row['ADM_ATIVO']);
        }

        return null;
    }

    public function save(User $user): bool
    {
        $sql = "INSERT INTO ADMINISTRADOR (ADM_NOME, ADM_EMAIL, ADM_SENHA, ADM_ATIVO) VALUES (:nome, :email, :senha, :ativo)";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':nome', $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':senha', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':ativo', $user->getActive(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function remove(int $id): void
    {
        session_start();

        $query = "DELETE FROM administrador WHERE ADM_ID = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION["msg"] = "Usuário excluído com sucesso!";
        } else {
            $_SESSION["msg"] = "Erro ao excluir o usuário!" . $stmt->errorInfo();
        }
    }

    public function update(User $user): bool
    {
        return true;
    }
}
