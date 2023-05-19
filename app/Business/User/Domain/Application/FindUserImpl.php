<?php

namespace App\Business\User\Domain\Application;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use App\Business\User\Port;
use App\Business\User\Port\Dto\UserOutputDto;
use App\Business\User\Port\UserRepository;

readonly final class FindUserImpl implements Port\Application\FindUser {

    public function __construct(private UserRepository $repo) {}

    public function execute(int $id): UserOutputDto {
        try {
            return UserOutputDto::fromUser($this->repo->find($id));
        } catch (ResourceNotFoundException $exception) {
            throw new BusinessException("User not found with id: $id");
        } catch (\Exception $exception) {
            throw new BusinessException("Service unavailable");
        }
    }
}