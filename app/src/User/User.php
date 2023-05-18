<?php

namespace App\src\User;

use App\src\Shared\EncrypterService;
use App\src\User\ValueObjects\Email;
use App\src\User\ValueObjects\Password;

class User {

    public readonly ?int $id;
    public readonly string $name;
    public readonly Email $email;
    public readonly Password $password;

    private function __construct(
        ?int $id, string $name, string $email,
        Password $password
    ) {

        $email = Email::build($email);

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function buildNonExistentUser(
        string $name,
        string $email,
        string $password,
        EncrypterService $encrypterService
    ): User {
        $password = Password::build($password, $encrypterService);
        return new User(null, $name, $email, $password);
    }

    public static function buildExistentUser(
        int $id,
        string $name,
        string $email,
        string $password
    ): User {
        $password = new Password($password);
        return new User($id, $name, $email, $password);
    }
}


