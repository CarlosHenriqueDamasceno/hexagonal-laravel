<?php

namespace App\Business\Category\Port\Dto;

use App\Business\Category\Domain\Category;
use App\Business\Category\Domain\TransactionType;

readonly class CategoryOutputDto {
    public int $id;
    public string $name;
    public TransactionType $type;

    public function __construct(int $id, string $name, TransactionType $type) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }


    public static function fromCategory(Category $category): CategoryOutputDto {
        return new CategoryOutputDto($category->id, $category->name, $category->type);
    }
}