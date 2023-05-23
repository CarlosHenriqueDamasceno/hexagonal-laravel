<?php

namespace App\Business\Category\Domain\Application;

use App\Business\Category\Port\Application\FindCategory;
use App\Business\Category\Port\CategoryRepository;
use App\Business\Category\Port\Dto\CategoryOutputDto;
use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;

readonly class FindCategoryImpl implements FindCategory {

    public function __construct(private CategoryRepository $repo) {}

    public function execute(int $id): CategoryOutputDto {
        try {
            return CategoryOutputDto::fromCategory($this->repo->find($id));
        } catch (ResourceNotFoundException $exception) {
            throw new BusinessException("Category not found with id: $id");
        } catch (\Exception $exception) {
            throw new BusinessException("Service unavailable");
        }
    }
}