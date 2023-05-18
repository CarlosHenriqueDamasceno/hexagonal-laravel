<?php

namespace Tests\Unit;

use App\src\Shared\BusinessException;
use App\src\Shared\EncrypterService;
use App\src\User\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase {

    public function test_should_instantiate_a_new_user(): void {
        $encrypterService = \Mockery::mock(EncrypterService::class);
        $encrypterService->shouldReceive('encrypt')->with(UserUnitTestUtils::$uncryptedPassword)->andReturn(
            UserUnitTestUtils::$encryptedPassword
        );
        $user = User::buildNonExistentUser(
            UserUnitTestUtils::$userName, UserUnitTestUtils::$validEmail, UserUnitTestUtils::$uncryptedPassword,
            $encrypterService
        );
        $this->assertEquals(UserUnitTestUtils::$encryptedPassword, $user->password->value);
        $this->assertNull($user->id);
    }

    public function test_should_instantiate_a_existent_user(): void {
        $user = User::buildExistentUser(
            1, UserUnitTestUtils::$userName, UserUnitTestUtils::$validEmail, UserUnitTestUtils::$encryptedPassword
        );
        $this->assertEquals(1, $user->id);
    }

    public function test_should_not_instantiate_user_with_invalid_email(): void {
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(UserUnitTestUtils::$invalidEmailErrorMessage);
        User::buildExistentUser(
            1, UserUnitTestUtils::$userName, UserUnitTestUtils::$invalidEmail, UserUnitTestUtils::$encryptedPassword
        );
    }
}
