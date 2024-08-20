<?php

namespace App\UseCase\UserUseCase;

use App\Http\Requests\userRequest\ActiveOrDeactiveRequest;
use App\Models\User;
use App\Repositories\UserRepository\DeactivateUserRepository;

class DeactivateUserUseCase
{
    private DeactivateUserRepository $deactivateUserRepository;

    public function __construct(DeactivateUserRepository $deactivateUserRepository)
    {
        $this->deactivateUserRepository = $deactivateUserRepository;
    }

    public function execute(ActiveOrDeactiveRequest $request): User
    {
        return $this->deactivateUserRepository->execute($request);
    }
}
