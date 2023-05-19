<?php

namespace App\Business\User\Port\Application;

use App\Business\User\Port\Dto\UserOutputDto;

interface FindUser {
    public function execute(int $id): UserOutputDto;
}