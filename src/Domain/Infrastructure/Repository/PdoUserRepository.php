<?php

namespace Alpha\Domain\Infrastructure\Repository;
use Alpha\Domain\Model\Repository\AdminRepository;
use stdClass;

class PdoUserRepository implements AdminRepository
{
    public function listAll() : array
    {
        return [];
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