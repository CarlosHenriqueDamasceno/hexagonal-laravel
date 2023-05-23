<?php

namespace App\Business\User\Port\Application;

use App\Business\User\Port\Dto\CreateUserInput;
use App\Business\User\Port\Dto\UserOutput;

interface CreateUser {
    public function execute(CreateUserInput $input): UserOutput;
}
