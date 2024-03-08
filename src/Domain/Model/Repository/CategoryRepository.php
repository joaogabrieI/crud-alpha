<?php
namespace Alpha\Domain\Model\Repository;

use Alpha\Domain\Model\Category;

interface CategoryRepository
{
    public function listAll() : array;
    public function save(Category $category) : bool;
    public function remove(int $id) : bool;
    public function update(Category $category) : bool;
}
