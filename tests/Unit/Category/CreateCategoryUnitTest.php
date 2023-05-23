<?php

namespace Tests\Unit\Category;

use App\Business\Category\Domain\Application\CreateCategoryImpl;
use App\Business\Category\Port\CategoryRepository;
use App\Business\Category\Port\Dto\CreateCategoryInput;
use PHPUnit\Framework\TestCase;

class CreateCategoryUnitTest extends TestCase {
    public function test_should_create_an_category(): void {
        $categoryRepository = \Mockery::mock(CategoryRepository::class);
        $categoryRepository->shouldReceive('create')->with(
            \Mockery::on(
                function ($arg) {
                    return CategoryUnitTestUtils::$toSaveCategory == $arg;
                }
            )
        )->andReturn(
            CategoryUnitTestUtils::$existentCategory
        );
        $createCategory = new CreateCategoryImpl($categoryRepository);
        $input = new CreateCategoryInput(
            CategoryUnitTestUtils::$categoryName, CategoryUnitTestUtils::$categoryType
        );
        $newCategory = $createCategory->execute($input);
        $this->assertEquals(1, $newCategory->id);
    }
}
