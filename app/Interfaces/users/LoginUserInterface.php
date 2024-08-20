<?php

namespace App\Interfaces\users;

use App\Http\Requests\userRequest\LoginRequest;
use App\Models\User;

interface LoginUserInterface
{
    public function execute(LoginRequest $request) : User;
}
