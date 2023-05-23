<?php

namespace App\Business\Category\Domain\Application;

use App\Business\Category\Domain\Category;
use App\Business\Category\Port\Application\CreateCategory;
use App\Business\Category\Port\CategoryRepository;
use App\Business\Category\Port\Dto\CategoryOutputDto;
use App\Business\Category\Port\Dto\CreateCategoryInput;

readonly class CreateCategoryImpl implements CreateCategory {

    public function __construct(
        private CategoryRepository $repo
    ) {}

    public function execute(CreateCategoryInput $input): CategoryOutputDto {
        $category = Category::buildNonExistentCategory(
            $input->name, $input->type
        );
        return CategoryOutputDto::fromCategory($this->repo->create($category));
    }
}
