<?php

namespace App\Repositories\UserRepository;

use App\Http\Requests\userRequest\ActiveOrDeactiveRequest;
use App\Interfaces\users\DeactivateUserInterface;
use App\Models\User;

class DeactivateUserRepository implements DeactivateUserInterface
{
    public function execute(ActiveOrDeactiveRequest $request) : User
    {
        $user = User::all()->find($request->input('user_id'));
        $user->status = 0;
        $user->save();
        return  $user;
    }
}
