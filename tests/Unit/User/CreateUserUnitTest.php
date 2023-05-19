<?php

namespace Tests\Unit\User;

use App\src\Shared\EncrypterService;
use App\src\User\CreateUserImpl;
use App\src\User\Ports\CreateUserInput;
use App\src\User\Ports\UserRepository;
use App\src\User\User;
use PHPUnit\Framework\TestCase;

class CreateUserUnitTest extends TestCase {
    public function test_should_create_an_user(): void {
        $encrypterService = \Mockery::mock(EncrypterService::class);
        $encrypterService
            ->shouldReceive('encrypt')
            ->with(UserUnitTestUtils::$uncryptedPassword)
            ->andReturn(
                UserUnitTestUtils::$encryptedPassword
            );
        $userToSave = User::buildNonExistentUser(
            UserUnitTestUtils::$userName, UserUnitTestUtils::$validEmail,
            UserUnitTestUtils::$uncryptedPassword,
            $encrypterService
        );
        $userRepository = \Mockery::mock(UserRepository::class);
        $userRepository->shouldReceive('create')->with(
            \Mockery::on(
                function ($arg) use ($userToSave) {
                    return $userToSave == $arg;
                }
            )
        )->andReturn(
            User::buildExistentUser(
                1,
                UserUnitTestUtils::$userName,
                UserUnitTestUtils::$validEmail,
                UserUnitTestUtils::$encryptedPassword
            )
        );
        $createUser = new CreateUserImpl($userRepository, $encrypterService);
        $input = new CreateUserInput(
            UserUnitTestUtils::$userName, UserUnitTestUtils::$validEmail,
            UserUnitTestUtils::$uncryptedPassword
        );
        $newUser = $createUser->execute($input);
        $this->assertEquals(1, $newUser->id);
    }
}
