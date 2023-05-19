<?php

namespace App\src\User\Ports;

use App\src\User\User;

interface CreateUser {
    public function execute(CreateUserInput $input): User;
}
