<?php

namespace App\Business\User\Port\Dto;

class UpdateUserInput {
    public function __construct(public readonly string $name) {}
}