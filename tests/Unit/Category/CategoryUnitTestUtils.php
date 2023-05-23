<?php

namespace Tests\Unit\Category;


use App\Business\Category\Domain\Category;

class CategoryUnitTestUtils {
    public static string $categoryName = "Delivery";
    public static string $updatedCategoryName = "Delivery editado";
    public static int $categoryType = 1;
    public static int $updatedCategoryType = 2;
    public static int $invalidCategoryType = 3;

    public static string $categoryNotFoundErrorMessage = "Category not found with id: 1";
    public static string $invalidTypeErrorMessage = "The given type is invalid!";
    public static string $invalidIdErrorMessage = "The id must be greater than 0";

    public static Category $existentCategory;
    public static Category $toSaveCategory;
    public static Category $updatedCategory;

    public static function init(): void {
        self::$toSaveCategory = Category::buildNonExistentCategory(
            CategoryUnitTestUtils::$categoryName,
            CategoryUnitTestUtils::$categoryType
        );
        self::$existentCategory = Category::buildExistentCategory(
            1,
            CategoryUnitTestUtils::$categoryName,
            CategoryUnitTestUtils::$categoryType
        );
        self::$updatedCategory = Category::buildExistentCategory(
            1,
            CategoryUnitTestUtils::$updatedCategoryName,
            CategoryUnitTestUtils::$updatedCategoryType
        );
    }

}

CategoryUnitTestUtils::init();
