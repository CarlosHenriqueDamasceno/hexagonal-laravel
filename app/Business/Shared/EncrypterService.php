<?php

namespace App\Business\Shared;

interface EncrypterService {
    public function encrypt(string $password): string;
}
