<?php

namespace App\Business\User\Domain;

use App\Business\Shared\EncrypterService;
use App\Business\Shared\Exception\BusinessException;
use App\Business\User\Domain\ValueObject\Email;
use App\Business\User\Domain\ValueObject\Password;
use function PHPUnit\Framework\isNull;

readonly class User {

    public ?int $id;
    public string $name;
    public Email $email;
    public Password $password;

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
        if ($id < 1)
            throw new BusinessException("The id must be greater than 0");
        $password = new Password($password);
        return new User($id, $name, $email, $password);
    }

    public function copyWith(?string $name): User {
        return new User(
            id: $this->id,
            name: (!isNull($name) ? $name : $this->name),
            email: $this->email->value,
            password: $this->password
        );
    }
}


