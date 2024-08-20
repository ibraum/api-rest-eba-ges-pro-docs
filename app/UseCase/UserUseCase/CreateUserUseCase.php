<?php

namespace App\UseCase\UserUseCase;


use App\Http\Requests\userRequest\UserRequest;
use App\Models\User;
use App\Repositories\UserRepository\CreateUserRepository;

class CreateUserUseCase
{
    private CreateUserRepository $createUserRepository;

    public function __construct(CreateUserRepository $createUserRepository)
    {
        $this->createUserRepository = $createUserRepository;
    }

    public function execute(UserRequest $request): User
    {
        return $this->createUserRepository->execute($request);
    }
}
