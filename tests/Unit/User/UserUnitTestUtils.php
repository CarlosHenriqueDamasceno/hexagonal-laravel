<?php

namespace Tests\Unit\User;


use App\Business\Shared\EncrypterService;
use App\Business\User\User;

class UserUnitTestUtils {
    public static string $userName = "Carlos Henrique";
    public static string $validEmail = "carlos@teste.com";
    public static string $invalidEmail = "carlos@teste";
    public static string $uncryptedPassword = "123123123";
    public static string $invalidPassword = "123";
    public static string $encryptedPassword = "88ea39439e74fa27c09a4fc0bc8ebe6d00978392";

    public static string $invalidEmailErrorMessage = "The given E-mail is invalid!";
    public static string $invalidPasswordErrorMessage = "The password must have at least 8 characters!";
    public static string $invalidIdErrorMessage = "The id must be greater than 0";

    public static User $existentUser;
    public static User $toSaveUser;

    public static function init() {
        $encrypterService = \Mockery::mock(EncrypterService::class);
        $encrypterService
            ->shouldReceive('encrypt')
            ->with(UserUnitTestUtils::$uncryptedPassword)
            ->andReturn(
                UserUnitTestUtils::$encryptedPassword
            );
        self::$toSaveUser = User::buildNonExistentUser(
            UserUnitTestUtils::$userName, UserUnitTestUtils::$validEmail,
            UserUnitTestUtils::$uncryptedPassword,
            $encrypterService
        );
        self::$existentUser = User::buildExistentUser(
            1,
            UserUnitTestUtils::$userName,
            UserUnitTestUtils::$validEmail,
            UserUnitTestUtils::$encryptedPassword
        );
    }

}

UserUnitTestUtils::init();
