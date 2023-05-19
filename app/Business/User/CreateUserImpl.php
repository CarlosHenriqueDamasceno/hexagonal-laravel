<?php

namespace App\Business\User;

use App\Business\Shared\EncrypterService;
use App\Business\User\Port\CreateUser;
use App\Business\User\Port\CreateUserInput;
use App\Business\User\Port\UserRepository;

readonly class CreateUserImpl implements CreateUser {

    public function __construct(
        private UserRepository $repo, private EncrypterService $encrypterService
    ) {}

    public function execute(CreateUserInput $input): User {
        $user = User::buildNonExistentUser(
            $input->name, $input->email, $input->password, $this->encrypterService
        );
        return $this->repo->create($user);
    }
}
