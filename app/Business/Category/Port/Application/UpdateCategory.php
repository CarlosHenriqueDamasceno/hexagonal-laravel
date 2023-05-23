<?php

namespace App\Business\Category\Port\Application;

use App\Business\Category\Port\Dto\CategoryOutputDto;
use App\Business\Category\Port\Dto\UpdateCategoryInput;

interface UpdateCategory {
    public function execute(int $id, UpdateCategoryInput $data): CategoryOutputDto;
}