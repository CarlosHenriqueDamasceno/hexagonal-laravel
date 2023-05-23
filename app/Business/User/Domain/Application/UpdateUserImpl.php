<?php

namespace App\Business\User\Domain\Application;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use App\Business\User\Port\Application\UpdateUser;
use App\Business\User\Port\Dto\UpdateUserInput;
use App\Business\User\Port\Dto\UserOutput;
use App\Business\User\Port\UserRepository;

readonly class UpdateUserImpl implements UpdateUser {

    public function __construct(private UserRepository $repo) {}

    public function execute(int $id, UpdateUserInput $data): UserOutput {
        try {
            $user = $this->repo->find($id);
            $user = $user->copyWith($data->name);
            return UserOutput::fromUser($this->repo->update($user));
        } catch (ResourceNotFoundException $exception) {
            throw new BusinessException("User not found with id: $id");
        } catch (\Exception $exception) {
            throw new BusinessException("Service unavailable");
        }
    }
}