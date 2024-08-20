<?php

namespace App\Repositories\UserRepository;

use App\Http\Requests\userRequest\LoginRequest;
use App\Interfaces\users\LoginUserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginUserRepository implements LoginUserInterface
{

    public function execute(LoginRequest $request): User
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = new User();
            $user->email = $request->email;
            $user->password = $request->password;
            return $user;
        }
        $user = new User();
        $user->fullname = "Kokou";
        $user->email = "kokou@gmail.com";
        $user->password = Hash::make("kokou");
        return $user;
    }
}
