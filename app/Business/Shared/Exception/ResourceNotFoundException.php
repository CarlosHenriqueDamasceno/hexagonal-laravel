<?php

namespace App\Business\Shared\Exception;

class ResourceNotFoundException extends \RuntimeException {
    public function __construct(string $message) {
        parent::__construct($message);
    }
}