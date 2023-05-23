<?php

namespace Tests\Unit\Category;

use App\Business\Category\Domain\Application\UpdateCategoryImpl;
use App\Business\Category\Port\CategoryRepository;
use App\Business\Category\Port\Dto\UpdateCategoryInput;
use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use PHPUnit\Framework\TestCase;

class UpdateCategoryUnitTest extends TestCase {
    public function test_should_update_user(): void {
        $userRepository = \Mockery::mock(CategoryRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andReturn(
                CategoryUnitTestUtils::$existentCategory
            );
        $userRepository
            ->shouldReceive('update')
            ->with(
                \Mockery::on(
                    function ($param) { return $param == CategoryUnitTestUtils::$updatedCategory; }
                )
            )
            ->andReturn(
                CategoryUnitTestUtils::$updatedCategory
            );
        $input = new UpdateCategoryInput(
            CategoryUnitTestUtils::$updatedCategoryName, CategoryUnitTestUtils::$updatedCategoryType
        );
        $updateCategory = new UpdateCategoryImpl($userRepository);
        $user = $updateCategory->execute(1, $input);
        $this->assertEquals(CategoryUnitTestUtils::$updatedCategoryName, $user->name);
    }

    public function test_should_not_update_user_invalid_id(): void {
        $userRepository = \Mockery::mock(CategoryRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andThrow(
                ResourceNotFoundException::class
            );
        $input = new UpdateCategoryInput(
            CategoryUnitTestUtils::$updatedCategoryName, CategoryUnitTestUtils::$updatedCategoryType
        );
        $update = new UpdateCategoryImpl($userRepository);
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$categoryNotFoundErrorMessage);
        $update->execute(1, $input);
    }
}