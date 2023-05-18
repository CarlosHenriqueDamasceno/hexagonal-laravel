<?php

namespace App\src\User\Ports;


use App\src\User\User;

interface UserRepository {
    public function create(User $user): User;
}
