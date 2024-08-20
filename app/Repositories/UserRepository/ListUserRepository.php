<?php

namespace App\Repositories\UserRepository;

use App\Interfaces\users\ListUserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ListUserRepository implements ListUserInterface
{

    public function execute(): Collection
    {
        return User::all();
    }
}
