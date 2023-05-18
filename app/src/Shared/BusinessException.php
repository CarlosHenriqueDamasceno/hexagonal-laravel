<?php

namespace App\src\Shared;

class BusinessException extends \RuntimeException {
    public function __construct(string $message) {
        parent::__construct($message);
    }
}
