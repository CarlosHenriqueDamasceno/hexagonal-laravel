<?php

namespace Tests\Unit\User;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Port\EncryptService;
use App\Business\User\Domain\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase {

    public function test_should_instantiate_a_new_user(): void {
        $encrypterService = \Mockery::mock(EncryptService::class);
        $encrypterService->shouldReceive('encrypt')->with(CategoryUnitTestUtils::$uncryptedPassword)
            ->andReturn(
                CategoryUnitTestUtils::$encryptedPassword
            );
        $user = User::buildNonExistentUser(
            CategoryUnitTestUtils::$userName, CategoryUnitTestUtils::$validEmail,
            CategoryUnitTestUtils::$uncryptedPassword,
            $encrypterService
        );
        $this->assertEquals(CategoryUnitTestUtils::$encryptedPassword, $user->password->value);
        $this->assertNull($user->id);
    }

    public function test_should_instantiate_a_existent_user(): void {
        $user = User::buildExistentUser(
            1, CategoryUnitTestUtils::$userName, CategoryUnitTestUtils::$validEmail,
            CategoryUnitTestUtils::$encryptedPassword
        );
        $this->assertEquals(1, $user->id);
    }

    public function test_should_not_instantiate_user_with_invalid_email(): void {
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$invalidEmailErrorMessage);
        User::buildExistentUser(
            1, CategoryUnitTestUtils::$userName, CategoryUnitTestUtils::$invalidEmail,
            CategoryUnitTestUtils::$encryptedPassword
        );
    }

    public function test_should_not_instantiate_user_with_invalid_password(): void {
        $encrypterService = \Mockery::mock(EncryptService::class);
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$invalidPasswordErrorMessage);
        User::buildNonExistentUser(
            CategoryUnitTestUtils::$userName, CategoryUnitTestUtils::$validEmail,
            CategoryUnitTestUtils::$invalidPassword,
            $encrypterService
        );
    }

    public function test_should_not_instantiate_existent_user_with_invalid_id(): void {
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$invalidIdErrorMessage);
        User::buildExistentUser(
            0, CategoryUnitTestUtils::$userName, CategoryUnitTestUtils::$validEmail,
            CategoryUnitTestUtils::$invalidPassword
        );
    }
}
