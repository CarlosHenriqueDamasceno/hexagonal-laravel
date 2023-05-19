<?php

namespace App\Business\User\Port;


use App\Business\User\Domain\User;

interface UserRepository {
    public function create(User $user): User;

    public function find(int $id): User;
}
