<?php

namespace App\Business\Category\Domain\Application;

use App\Business\Category\Port\Application\DeleteCategory;
use App\Business\Category\Port\CategoryRepository;
use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;

readonly class DeleteCategoryImpl implements DeleteCategory {

    public function __construct(private CategoryRepository $repo) {}

    public function execute(int $id): void {
        try {
            $this->repo->find($id);
            $this->repo->delete($id);
        } catch (ResourceNotFoundException $exception) {
            throw new BusinessException("Category not found with id: $id");
        } catch (\Exception $exception) {
            throw new BusinessException("Service unavailable");
        }
    }
}