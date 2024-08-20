<?php

namespace App\UseCase\UserUseCase;

use App\Repositories\UserRepository\ListUserRepository;
use Illuminate\Database\Eloquent\Collection;

class ListUserUseCase
{
    private ListUserRepository $listUserRepository;

    public function __construct(ListUserRepository $listUserRepository)
    {
        $this->listUserRepository = $listUserRepository;
    }

    public function execute(): Collection
    {
        return $this->listUserRepository->execute();
    }
}
