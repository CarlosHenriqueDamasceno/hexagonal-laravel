<?php

namespace Tests\Unit\User;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use App\Business\User\Domain\Application\UpdateUserImpl;
use App\Business\User\Port\Dto\UpdateUserInput;
use App\Business\User\Port\UserRepository;
use PHPUnit\Framework\TestCase;

class UpdateUserUnitTest extends TestCase {
    public function test_should_update_user(): void {
        $userRepository = \Mockery::mock(UserRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andReturn(
                CategoryUnitTestUtils::$existentUser
            );
        $userRepository
            ->shouldReceive('update')
            ->with(
                \Mockery::on(
                    function ($param) { return $param == CategoryUnitTestUtils::$updatedUser; }
                )
            )
            ->andReturn(
                CategoryUnitTestUtils::$updatedUser
            );
        $input = new UpdateUserInput(CategoryUnitTestUtils::$updatedUserName);
        $updateUser = new UpdateUserImpl($userRepository);
        $user = $updateUser->execute(1, $input);
        $this->assertEquals(CategoryUnitTestUtils::$updatedUserName, $user->name);
    }

    public function test_should_not_update_user_invalid_id(): void {
        $userRepository = \Mockery::mock(UserRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andThrow(
                ResourceNotFoundException::class
            );
        $input = new UpdateUserInput(CategoryUnitTestUtils::$updatedUserName);
        $update = new UpdateUserImpl($userRepository);
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$userNotFoundErrorMessage);
        $update->execute(1, $input);
    }
}