<?php

namespace Alpha\Domain\Infrastructure\Repository;

use Alpha\Domain\Infrastructure\Persistence\ConnectCreator;
use Alpha\Domain\Entity\Repository\UserRepository;
use Alpha\Domain\Entity\User;
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
            $users[] = new User
            (
                $row['id'], 
                $row['name'], 
                $row['name'], 
                $row['password']
            );
        }

        return $users;
    }

    public function findById(int $id)
    {
        $query = "SELECT * FROM administrador WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User
            (
                $row['id'], 
                $row['name'], 
                $row['email'], 
                $row['password']
            );
        }

        return null;
    }

    public function save(User $user): bool
    {
        $sql = "INSERT INTO administrador (name, email, password) VALUES (:nome, :email, :senha)";
        $senha = password_hash($user->getPassword(), PASSWORD_ARGON2ID);

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(':nome', $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':senha', $senha, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function remove(int $id): bool
    {
        session_start();

        $query = "DELETE FROM administrador WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();

    }

    public function update(User $user): bool
    {
        $sql = "UPDATE administrador SET name = :nome, email = :email WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":nome", $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":id", $user->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function changePassword(User $user, string $confirmPassword)
    {
        if ($user->checkPassword($user->getPassword(), $confirmPassword)) {
            $password = password_hash($user->getPassword(), PASSWORD_ARGON2ID);

            $sql = "UPDATE administrador SET senha = :senha WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":senha", $password, PDO::PARAM_STR);
            $stmt->bindValue(":id", $user->getId(), PDO::PARAM_INT);

            return $stmt->execute();
        } else {
            return false;
        }
    }

    public function findByEmail(string $email): User|null
    {
        $query = 'SELECT * FROM administrador WHERE email = :email';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User
            (
                $row['id'], 
                $row['name'], 
                $row['email'], 
                $row['password']
            );
        }

        return null;
    }
}
