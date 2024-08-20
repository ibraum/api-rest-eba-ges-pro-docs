<?php

namespace App\UseCase\UserUseCase;

use App\Http\Requests\userRequest\LoginRequest;
use App\Models\User;
use App\Repositories\UserRepository\LoginUserRepository;

class LoginUserUseCase
{
    private LoginUserRepository $loginUserRepository;

    public function __construct(LoginUserRepository $loginUserRepository)
    {
        $this->loginUserRepository = $loginUserRepository;
    }

    public function execute(LoginRequest $request): User
    {
        return $this->loginUserRepository->execute($request);
    }
}
