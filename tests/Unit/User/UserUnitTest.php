<?php

namespace Tests\Unit\User;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Port\EncryptService;
use App\Business\User\Domain\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase {

    public function test_should_instantiate_a_new_user(): void {
        $encrypterService = \Mockery::mock(EncryptService::class);
        $encrypterService->shouldReceive('encrypt')->with(UserUnitTestUtils::$uncryptedPassword)
            ->andReturn(
                UserUnitTestUtils::$encryptedPassword
            );
        $user = User::buildNonExistentUser(
            UserUnitTestUtils::$userName, UserUnitTestUtils::$validEmail,
            UserUnitTestUtils::$uncryptedPassword,
            $encrypterService
        );
        $this->assertEquals(UserUnitTestUtils::$encryptedPassword, $user->password->value);
        $this->assertNull($user->id);
    }

    public function test_should_instantiate_a_existent_user(): void {
        $user = User::buildExistentUser(
            1, UserUnitTestUtils::$userName, UserUnitTestUtils::$validEmail,
            UserUnitTestUtils::$encryptedPassword
        );
        $this->assertEquals(1, $user->id);
    }

    public function test_should_not_instantiate_user_with_invalid_email(): void {
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(UserUnitTestUtils::$invalidEmailErrorMessage);
        User::buildExistentUser(
            1, UserUnitTestUtils::$userName, UserUnitTestUtils::$invalidEmail,
            UserUnitTestUtils::$encryptedPassword
        );
    }

    public function test_should_not_instantiate_user_with_invalid_password(): void {
        $encrypterService = \Mockery::mock(EncryptService::class);
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(UserUnitTestUtils::$invalidPasswordErrorMessage);
        User::buildNonExistentUser(
            UserUnitTestUtils::$userName, UserUnitTestUtils::$validEmail,
            UserUnitTestUtils::$invalidPassword,
            $encrypterService
        );
    }

    public function test_should_not_instantiate_existent_user_with_invalid_id(): void {
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(UserUnitTestUtils::$invalidIdErrorMessage);
        User::buildExistentUser(
            0, UserUnitTestUtils::$userName, UserUnitTestUtils::$validEmail,
            UserUnitTestUtils::$invalidPassword
        );
    }
}
