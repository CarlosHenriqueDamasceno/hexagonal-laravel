<?php

namespace App\Business\User\Domain\Application;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use App\Business\User\Port\Application\FindUser;
use App\Business\User\Port\Dto\UserOutput;
use App\Business\User\Port\UserRepository;

readonly class FindUserImpl implements FindUser {

    public function __construct(private UserRepository $repo) {}

    public function execute(int $id): UserOutput {
        try {
            return UserOutput::fromUser($this->repo->find($id));
        } catch (ResourceNotFoundException $exception) {
            throw new BusinessException("User not found with id: $id");
        } catch (\Exception $exception) {
            throw new BusinessException("Service unavailable");
        }
    }
}