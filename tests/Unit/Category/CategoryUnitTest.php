<?php

namespace Tests\Unit\Category;

use App\Business\Category\Domain\Category;
use App\Business\Shared\Exception\BusinessException;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase {

    public function test_should_instantiate_a_new_user(): void {
        $user = Category::buildNonExistentCategory(
            CategoryUnitTestUtils::$categoryName, CategoryUnitTestUtils::$categoryType
        );
        $this->assertNull($user->id);
    }

    public function test_should_instantiate_a_existent_user(): void {
        $user = Category::buildExistentCategory(
            1, CategoryUnitTestUtils::$categoryName, CategoryUnitTestUtils::$categoryType
        );
        $this->assertEquals(1, $user->id);
    }

    public function test_should_not_instantiate_user_with_invalid_type(): void {
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$invalidTypeErrorMessage);
        Category::buildExistentCategory(
            1, CategoryUnitTestUtils::$categoryName, CategoryUnitTestUtils::$invalidCategoryType
        );
    }

    public function test_should_not_instantiate_existent_user_with_invalid_id(): void {
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$invalidIdErrorMessage);
        Category::buildExistentCategory(
            0, CategoryUnitTestUtils::$categoryName, CategoryUnitTestUtils::$categoryType
        );
    }
}
