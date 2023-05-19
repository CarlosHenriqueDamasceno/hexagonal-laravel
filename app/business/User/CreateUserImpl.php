<?php

namespace App\src\User;

use App\src\Shared\EncrypterService;
use App\src\User\Ports\CreateUser;
use App\src\User\Ports\CreateUserInput;
use App\src\User\Ports\UserRepository;

readonly class CreateUserImpl implements CreateUser {

    public function __construct(
        private UserRepository $repo, private EncrypterService $encrypterService
    ) {}

    public function execute(CreateUserInput $input): User {
        $user = User::buildNonExistentUser($input->name, $input->email, $input->password, $this->encrypterService);
        return $this->repo->create($user);
    }
}
