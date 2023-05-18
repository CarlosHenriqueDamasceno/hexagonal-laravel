<?php

namespace Tests\Unit;

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

}
