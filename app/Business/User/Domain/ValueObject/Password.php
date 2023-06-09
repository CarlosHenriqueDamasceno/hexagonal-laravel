<?php

namespace App\Business\User\Domain\ValueObject;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Port\EncryptService;

class Password {
    public function __construct(public readonly string $value) {}

    public static function build(string $value, EncryptService $encrypterService): Password {
        if (strlen($value) > 8) {
            return new Password($encrypterService->encrypt($value));
        } else {
            throw new BusinessException("The password must have at least 8 characters!");
        }
    }
}
