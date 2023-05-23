<?php

namespace App\Business\Category\Domain\Application;

use App\Business\Category\Port\Application\UpdateCategory;
use App\Business\Category\Port\CategoryRepository;
use App\Business\Category\Port\Dto\CategoryOutputDto;
use App\Business\Category\Port\Dto\UpdateCategoryInput;
use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;

readonly class UpdateCategoryImpl implements UpdateCategory {

    public function __construct(private CategoryRepository $repo) {}

    public function execute(int $id, UpdateCategoryInput $data): CategoryOutputDto {
        try {
            $category = $this->repo->find($id);
            $category = $category->copyWith($data->name, $data->type);
            return CategoryOutputDto::fromCategory($this->repo->update($category));
        } catch (ResourceNotFoundException $exception) {
            throw new BusinessException("Category not found with id: $id");
        } catch (\Exception $exception) {
            throw new BusinessException("Service unavailable");
        }
    }
}