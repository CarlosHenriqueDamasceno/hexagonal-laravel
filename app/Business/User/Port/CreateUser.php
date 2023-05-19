<?php

namespace App\Business\User\Port;

use App\Business\User\User;

interface CreateUser {
    public function execute(CreateUserInput $input): User;
}
