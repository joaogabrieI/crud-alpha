<?php

namespace Alpha\Domain\Model\Repository;

use Alpha\Domain\Model\Produto;
use stdClass;

interface AdminRepository
{
    public function listAll() : array;
    public function save(Produto $produto) : bool;
    public function remove(Produto $produto) : bool;

    public function update(Produto $produto) : bool;
}
