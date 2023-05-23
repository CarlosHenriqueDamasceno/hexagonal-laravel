<?php

namespace App\Business\Category\Port\Application;

use App\Business\Category\Port\Dto\CategoryOutputDto;
use App\Business\Category\Port\Dto\CreateCategoryInput;

interface CreateCategory {
    public function execute(CreateCategoryInput $input): CategoryOutputDto;
}
