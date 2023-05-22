<?php

namespace App\Business\Shared\Port;

interface EncryptService {
    public function encrypt(string $password): string;
}
