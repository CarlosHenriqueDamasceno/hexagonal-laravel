<?php

namespace App\Business\User\Port;

class CreateUserInput {
    public function __construct(
        public readonly string $name, public readonly string $email,
        public readonly string $password
    ) {}
}
