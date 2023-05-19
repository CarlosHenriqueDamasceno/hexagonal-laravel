<?php

namespace Tests\Unit\User;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use App\Business\User\Domain\Application\FindUserImpl;
use App\Business\User\Port\UserRepository;
use PHPUnit\Framework\TestCase;

class GetUserUnitTest extends TestCase {
    public function test_should_find_user(): void {
        $userRepository = \Mockery::mock(UserRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andReturn(
                UserUnitTestUtils::$existentUser
            );
        $findUser = new FindUserImpl($userRepository);
        $user = $findUser->execute(1);
        $this->assertEquals(1, $user->id,);
        $this->assertEquals(UserUnitTestUtils::$userName, $user->name);
    }

    public function test_should_not_find_user(): void {
        $userRepository = \Mockery::mock(UserRepository::class);
        $userRepository
            ->shouldReceive('find')
            ->with(1)
            ->andThrow(
                ResourceNotFoundException::class
            );
        $this->expectException(BusinessException::class);
        $this->expectExceptionMessage(UserUnitTestUtils::$userNotFoundErrorMessage);
        $findUser = new FindUserImpl($userRepository);
        $user = $findUser->execute(1);
    }
}