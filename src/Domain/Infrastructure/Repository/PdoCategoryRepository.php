<?php

namespace Alpha\Domain\Infrastructure\Repository;

use Alpha\Domain\Model\Repository\CategoryRepository;
use Alpha\Domain\Model\Category;

class PdoCategoryRepository implements CategoryRepository
{
    private $connection;

    public function listAll() : array
    {
        return [];
    }
    public function save(Category $category) : bool
    {
        return true;
    }
    public function remove(int $id) : bool
    {
        return true;
    }
    public function update(Category $category) : bool
    {
        return true;
    }
}