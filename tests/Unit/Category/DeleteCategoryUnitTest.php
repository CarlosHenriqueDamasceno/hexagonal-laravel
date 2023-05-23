<?php

namespace Tests\Unit\Category;

use App\Business\Category\Domain\Application\DeleteCategoryImpl;
use App\Business\Category\Port\CategoryRepository;
use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use PHPUnit\Framework\TestCase;

class DeleteCategoryUnitTest extends TestCase {
    public function test_should_delete_user(): void {
        $userRepository = \Mockery::spy(CategoryRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andReturn(
                CategoryUnitTestUtils::$existentCategory
            );
        $deleteCategory = new DeleteCategoryImpl($userRepository);
        $deleteCategory->execute(1);
        $userRepository
            ->shouldHaveReceived('delete')
            ->with(1);
        $this->assertTrue(true);
    }

    public function test_should_not_delete_user_invalid_id(): void {
        $userRepository = \Mockery::mock(CategoryRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andThrow(
                ResourceNotFoundException::class
            );
        $update = new DeleteCategoryImpl($userRepository);
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$categoryNotFoundErrorMessage);
        $update->execute(1);
    }
}