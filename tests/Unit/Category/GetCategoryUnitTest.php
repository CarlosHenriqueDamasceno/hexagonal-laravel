<?php

namespace Tests\Unit\Category;

use App\Business\Category\Domain\Application\FindCategoryImpl;
use App\Business\Category\Port\CategoryRepository;
use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use PHPUnit\Framework\TestCase;

class GetCategoryUnitTest extends TestCase {
    public function test_should_find_user(): void {
        $userRepository = \Mockery::mock(CategoryRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andReturn(
                CategoryUnitTestUtils::$existentCategory
            );
        $findCategory = new FindCategoryImpl($userRepository);
        $user = $findCategory->execute(1);
        $this->assertEquals(1, $user->id,);
        $this->assertEquals(CategoryUnitTestUtils::$categoryName, $user->name);
    }

    public function test_should_not_find_user(): void {
        $userRepository = \Mockery::mock(CategoryRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andThrow(
                ResourceNotFoundException::class
            );
        $findCategory = new FindCategoryImpl($userRepository);
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$categoryNotFoundErrorMessage);
        $findCategory->execute(1);
    }
}