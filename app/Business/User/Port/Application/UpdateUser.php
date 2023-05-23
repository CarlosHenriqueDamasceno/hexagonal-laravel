<?php

namespace App\Business\User\Port\Application;

use App\Business\User\Port\Dto\UpdateUserInput;
use App\Business\User\Port\Dto\UserOutput;

interface UpdateUser {
    public function execute(int $id, UpdateUserInput $data): UserOutput;
}