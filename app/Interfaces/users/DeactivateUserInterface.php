<?php

namespace App\Interfaces\users;

use App\Http\Requests\userRequest\ActiveOrDeactiveRequest;
use App\Models\User;

interface DeactivateUserInterface
{
    public function execute(ActiveOrDeactiveRequest $request) : User;
}
