<?php

namespace Alpha\Domain\Model;

class Produto {
    private int $id;
    private string $name;
    private string $description;
    private float $price;
    private int $discount;
    private Category $category;
    private int $amount;
    private int $active;
    private Image $image;

    public function __construct(int $id, string $name, string $description, float $price, int $discount, Category $category, int $amount, Image $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->discount = $discount;
        $this->category = $category;
        $this->amount = $amount;
        $this->image = $image;
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

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getActive(): int
    {
        return $this->active;
    }
}