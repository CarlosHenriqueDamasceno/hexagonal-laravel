<?php

namespace Tests\Unit;

class UserUnitTestUtils {
    public static $userName = "Carlos Henrique";
    public static $validEmail = "carlos@teste.com";
    public static $invalidEmail = "carlos@teste";
    public static $uncryptedPassword = "123123123";
    public static $invalidPassword = "123";
    public static $encryptedPassword = "88ea39439e74fa27c09a4fc0bc8ebe6d00978392";


    public static $invalidEmailErrorMessage = "The given E-mail is invalid!";
}
