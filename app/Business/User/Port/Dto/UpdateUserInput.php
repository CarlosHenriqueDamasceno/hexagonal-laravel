<?php

namespace App\Business\User\Port\Dto;

readonly class UpdateUserInput {
    public function __construct(public string $name) {}
}