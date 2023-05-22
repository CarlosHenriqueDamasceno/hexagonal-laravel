<?php

namespace App\Business\User\Port\Dto;

readonly class CreateUserInput {
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}
}
