<?php

namespace App\Business\Category\Port\Application;

use App\Business\Category\Port\Dto\CategoryOutputDto;

interface FindCategory {
    public function execute(int $id): CategoryOutputDto;
}