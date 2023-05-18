<?php

namespace App\src\Shared;

interface EncrypterService {
    public function encrypt(string $password): string;
}
