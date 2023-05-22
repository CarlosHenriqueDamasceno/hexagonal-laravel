<?php

namespace App\Business\User\Port\Application;

interface DeleteUser {
    public function execute(int $id): void;
}