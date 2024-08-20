<?php

namespace App\Interfaces\users;


use App\Http\Requests\userRequest\UserRequest;
use App\Models\User;

interface CreateUserInterface
{
    public function execute(UserRequest $request) : User;
}
