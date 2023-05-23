<?php

namespace App\Business\Category\Port\Dto;

readonly class UpdateCategoryInput {
    public string $name;
    public int $type;

    public function __construct(string $name, int $type) {
        $this->name = $name;
        $this->type = $type;
    }
}