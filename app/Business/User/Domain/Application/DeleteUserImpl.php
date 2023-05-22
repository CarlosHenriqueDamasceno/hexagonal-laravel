<?php

namespace App\Business\User\Domain\Application;

use App\Business\Shared\Exception\BusinessException;
use App\Business\Shared\Exception\ResourceNotFoundException;
use App\Business\User\Port\Application\DeleteUser;
use App\Business\User\Port\UserRepository;

readonly class DeleteUserImpl implements DeleteUser {

    public function __construct(private UserRepository $repo) {}

    public function execute(int $id): void {
        try {
            $this->repo->find($id);
            $this->repo->delete($id);
        } catch (ResourceNotFoundException $exception) {
            throw new BusinessException("User not found with id: $id");
        } catch (\Exception $exception) {
            throw new BusinessException("Service unavailable");
        }
    }
}