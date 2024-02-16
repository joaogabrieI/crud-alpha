<?php

namespace Alpha\Domain\Model\Repository;

use Alpha\Domain\Model\Produto;
use stdClass;

interface UserRepository
{
    public function listAll() : array;
    public function save(Produto $produto) : bool;
    public function remove(int $id) : void;

    public function update(Produto $produto) : bool;
}
