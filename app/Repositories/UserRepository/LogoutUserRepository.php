<?php

namespace App\Repositories\UserRepository;

use App\Interfaces\users\LogoutUserInterface;
use Illuminate\Support\Facades\Auth;

class LogoutUserRepository implements LogoutUserInterface
{
    public function execute() : void
    {
        Auth::logout();
    }
}
