<?php

namespace App\src\User\Ports;

class CreateUserInput {
    public function __construct(
        public readonly string $name, public readonly string $email, public readonly string $password
    ) {}
}
