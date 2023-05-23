<?php

namespace Tests\Unit\User;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use App\Business\User\Domain\Application\DeleteUserImpl;
use App\Business\User\Port\UserRepository;
use PHPUnit\Framework\TestCase;

class DeleteUserUnitTest extends TestCase {
    public function test_should_delete_user(): void {
        $userRepository = \Mockery::spy(UserRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andReturn(
                CategoryUnitTestUtils::$existentUser
            );
        $deleteUser = new DeleteUserImpl($userRepository);
        $deleteUser->execute(1);
        $userRepository
            ->shouldHaveReceived('delete')
            ->with(1);
        $this->assertTrue(true);
    }

    public function test_should_not_delete_user_invalid_id(): void {
        $userRepository = \Mockery::mock(UserRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andThrow(
                ResourceNotFoundException::class
            );
        $update = new DeleteUserImpl($userRepository);
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(CategoryUnitTestUtils::$userNotFoundErrorMessage);
        $update->execute(1);
    }
}