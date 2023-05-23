<?php

namespace App\Business\Category\Domain;

use App\Business\Shared\Exception\BusinessException;

readonly class Category {
    public ?int $id;
    public string $name;
    public TransactionType $type;

    public function __construct(?int $id, string $name, int $type) {

        if (TransactionType::tryFrom($type) == null)
            throw new BusinessException("The given type is invalid!");

        $this->id = $id;
        $this->name = $name;
        $this->type = TransactionType::from($type);
    }

    public static function buildNonExistentCategory(string $name, int $type
    ): Category {
        return new Category(null, $name, $type);
    }

    public static function buildExistentCategory(int $id, string $name, int $type
    ): Category {
        if ($id < 1)
            throw new BusinessException("The id must be greater than 0");
        return new Category($id, $name, $type);
    }

    public function copyWith(?string $name, ?int $type): Category {
        return new Category(
            $this->id,
            !is_null($name) ? $name : $this->name,
            !is_null($type) ? $type : $this->type->value
        );
    }
}