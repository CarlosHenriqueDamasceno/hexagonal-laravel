<?php

namespace App\Business\User\Port\Application;

use App\Business\User\Port\Dto\UserOutput;

interface FindUser {
    public function execute(int $id): UserOutput;
}