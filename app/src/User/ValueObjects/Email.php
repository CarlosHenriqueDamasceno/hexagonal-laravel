<?php

namespace App\src\User\ValueObjects;

use App\src\Shared\BusinessException;

class Email {

    private function __construct(public readonly string $value) {}

    public static function build(string $value): Email {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return new Email($value);
        } else {
            throw new BusinessException("The given E-mail is invalid!");
        }
    }
}
