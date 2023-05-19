<?php

namespace App\Business\User\Port;


use App\Business\User\User;

interface UserRepository {
    public function create(User $user): User;
}
