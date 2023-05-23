<?php

namespace Tests\Unit\User;


use App\Business\Shared\Port\EncryptService;
use App\Business\User\Domain\User;

class UserUnitTestUtils {
    public static string $userName = "Carlos Henrique";
    public static string $updatedUserName = "Carlos Henrique editado";
    public static string $validEmail = "carlos@teste.com";
    public static string $invalidEmail = "carlos@teste";
    public static string $uncryptedPassword = "123123123";
    public static string $invalidPassword = "123";
    public static string $encryptedPassword = "88ea39439e74fa27c09a4fc0bc8ebe6d00978392";

    public static string $userNotFoundErrorMessage = "User not found with id: 1";
    public static string $invalidEmailErrorMessage = "The given E-mail is invalid!";
    public static string $invalidPasswordErrorMessage = "The password must have at least 8 characters!";
    public static string $invalidIdErrorMessage = "The id must be greater than 0";

    public static User $existentUser;
    public static User $toSaveUser;
    public static User $updatedUser;

    public static function init(): void {
        $encrypterService = \Mockery::mock(EncryptService::class);
        $encrypterService
            ->shouldReceive('encrypt')
            ->with(CategoryUnitTestUtils::$uncryptedPassword)
            ->andReturn(
                CategoryUnitTestUtils::$encryptedPassword
            );
        self::$toSaveUser = User::buildNonExistentUser(
            CategoryUnitTestUtils::$userName, CategoryUnitTestUtils::$validEmail,
            CategoryUnitTestUtils::$uncryptedPassword,
            $encrypterService
        );
        self::$existentUser = User::buildExistentUser(
            1,
            CategoryUnitTestUtils::$userName,
            CategoryUnitTestUtils::$validEmail,
            CategoryUnitTestUtils::$encryptedPassword
        );
        self::$updatedUser = User::buildExistentUser(
            1,
            CategoryUnitTestUtils::$updatedUserName,
            CategoryUnitTestUtils::$validEmail,
            CategoryUnitTestUtils::$encryptedPassword
        );
    }

}

UserUnitTestUtils::init();
