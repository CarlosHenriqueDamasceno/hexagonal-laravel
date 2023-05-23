<?php

namespace App\Business\Category\Port;

use App\Business\Category\Domain\Category;

interface CategoryRepository {
    public function create(Category $user): Category;

    public function find(int $id): Category;

    public function update(Category $user): Category;

    public function delete(int $id): void;
}