<?php

namespace App\Business\User\Port\Dto;

use App\Business\User\Domain\User;

readonly class UserOutputDto {
    public int $id;
    public string $name;
    public string $email;
    public string $password;

    public function __construct(int $id, string $name, string $email, string $password) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
    
    public static function fromUser(User $user): UserOutputDto {
        return new UserOutputDto(
            $user->id,
            $user->name,
            $user->email->value,
            $user->password->value
        );
    }
}