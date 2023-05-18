<?php

namespace App\src\User\ValueObjects;

use App\src\Shared\BusinessException;
use App\src\Shared\EncrypterService;

class Password {
    public function __construct(public readonly string $value) {}

    public static function build(string $value, EncrypterService $encrypterService): Password {
        if (strlen($value) > 8) {
            return new Password($encrypterService->encrypt($value));
        } else {
            throw new BusinessException("The password must have at least 8 characters!");
        }
    }
}
