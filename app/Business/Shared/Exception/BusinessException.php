<?php

namespace App\Business\Shared\Exception;

class BusinessException extends \RuntimeException {
    public function __construct(string $message) {
        parent::__construct($message);
    }
}
