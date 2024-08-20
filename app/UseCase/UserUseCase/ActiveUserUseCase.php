<?php

namespace App\UseCase\UserUseCase;

use App\Http\Requests\userRequest\ActiveOrDeactiveRequest;
use App\Models\User;
use App\Repositories\UserRepository\ActiveUserRepository;

class ActiveUserUseCase
{
    private ActiveUserRepository $activeUserRepository;

    public function __construct(ActiveUserRepository $activeUserRepository)
    {
        $this->activeUserRepository = $activeUserRepository;
    }

    public function execute(ActiveOrDeactiveRequest $request): User
    {
        return $this->activeUserRepository->execute($request);
    }
}
