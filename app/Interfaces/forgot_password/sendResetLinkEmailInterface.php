<?php

namespace App\Interfaces\forgot_password;

use App\Http\Requests\userRequest\ValidateTokenEmailPasswordRequest;

interface sendResetLinkEmailInterface
{
    public function execute(ValidateTokenEmailPasswordRequest $request) : string;
}
