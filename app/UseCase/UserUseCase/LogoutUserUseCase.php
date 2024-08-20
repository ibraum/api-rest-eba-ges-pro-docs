<?php

namespace App\UseCase\UserUseCase;

use App\Repositories\UserRepository\LogoutUserRepository;

class LogoutUserUseCase
{
    private LogoutUserRepository $logoutUserRepository;

    public function __construct(LogoutUserRepository $logoutUserRepository)
    {
        $this->logoutUserRepository = $logoutUserRepository;
    }

    public function execute() : void
    {
        $this->logoutUserRepository->execute();
    }
}
