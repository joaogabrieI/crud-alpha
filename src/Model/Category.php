<?php

namespace Crud\Alpha\Model;

class Category
{
    protected int $id;
    private string $name;
    private string $description;
    private int $active;

    public function __construct(int $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->active = 1;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getActive(): int
    {
        return $this->active;
    }
}
