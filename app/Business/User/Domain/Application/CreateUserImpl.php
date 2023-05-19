<?php

namespace App\Business\User\Domain\Application;

use App\Business\Shared\EncrypterService;
use App\Business\User\Domain\User;
use App\Business\User\Port\Application\CreateUser;
use App\Business\User\Port\Dto\CreateUserInput;
use App\Business\User\Port\Dto\UserOutputDto;
use App\Business\User\Port\UserRepository;

readonly final class CreateUserImpl implements CreateUser {

    public function __construct(
        private UserRepository $repo, private EncrypterService $encrypterService
    ) {}

    public function execute(CreateUserInput $input): UserOutputDto {
        $user = User::buildNonExistentUser(
            $input->name, $input->email, $input->password, $this->encrypterService
        );
        return UserOutputDto::fromUser($this->repo->create($user));
    }
}
