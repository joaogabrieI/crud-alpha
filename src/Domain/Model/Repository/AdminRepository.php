<?php

namespace Alpha\Domain\Model\Repository;

use stdClass;

interface AdminRepository
{
    public function listAll() : array;
    public function save(stdClass $object) : bool;
    public function remove(stdClass $object) : bool;
}
