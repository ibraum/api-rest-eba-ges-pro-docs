<?php

namespace App\Repositories\UserRepository;


use App\Http\Requests\userRequest\UserRequest;
use App\Interfaces\users\CreateUserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserRepository implements CreateUserInterface
{

    public function execute(UserRequest $request): User
    {
        $user = new User();
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return $user;
    }
}
