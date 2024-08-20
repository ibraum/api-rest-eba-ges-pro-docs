<?php

namespace App\Repositories\UserRepository;

use App\Http\Requests\userRequest\ActiveOrDeactiveRequest;
use App\Interfaces\users\ActiveUserInterface;
use App\Models\User;

class ActiveUserRepository implements ActiveUserInterface
{

    public function execute(ActiveOrDeactiveRequest $request): User
    {
        $user = User::all()->find($request->input('user_id'));
        $user->status = 1;
        $user->save();

        return $user;
    }
}
