<?php

namespace App\Business\User\Port\Application;

use App\Business\User\Port\Dto\CreateUserInput;
use App\Business\User\Port\Dto\UserOutputDto;

interface CreateUser {
    public function execute(CreateUserInput $input): UserOutputDto;
}
