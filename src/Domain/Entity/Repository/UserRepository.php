<?php

namespace Alpha\Domain\Entity\Repository;

use Alpha\Domain\Entity\User;

interface UserRepository
{
    public function listAll() : array;
    public function findById(int $id);
    public function save(User $user) : bool;
    public function remove(int $id) : bool;
    public function update(User $user) : bool;
}