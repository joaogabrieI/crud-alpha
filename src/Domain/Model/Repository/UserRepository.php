<?php

namespace Alpha\Domain\Model\Repository;

use Alpha\Domain\Model\User;

interface UserRepository
{
    public function listAll() : array;
    public function save(User $user) : bool;
    public function remove(int $id) : void;

    public function update(User $user) : void;
}
