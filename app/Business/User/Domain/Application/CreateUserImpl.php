<?php

namespace App\Business\User\Domain\Application;

use App\Business\Shared\Port\EncryptService;
use App\Business\User\Domain\User;
use App\Business\User\Port\Application\CreateUser;
use App\Business\User\Port\Dto\CreateUserInput;
use App\Business\User\Port\Dto\UserOutput;
use App\Business\User\Port\UserRepository;

readonly  class CreateUserImpl implements CreateUser {

    public function __construct(
        private UserRepository $repo, private EncryptService $encrypterService
    ) {}

    public function execute(CreateUserInput $input): UserOutput {
        $user = User::buildNonExistentUser(
            $input->name, $input->email, $input->password, $this->encrypterService
        );
        return UserOutput::fromUser($this->repo->create($user));
    }
}
