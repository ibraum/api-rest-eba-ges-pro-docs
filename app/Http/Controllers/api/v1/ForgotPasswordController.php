<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\userRequest\ValidateEmailRequest;
use App\Http\Requests\userRequest\ValidateTokenEmailPasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(ValidateEmailRequest $request) : string
    {
        $email = $request->validated()['email'];

        $token = Str::random(60);

        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now(),
        ]);

        $resetLink = url('/password/reset/' . $token);
        //$json =json_decode(['resetLink' => $resetLink]);
        //$json_string = $json->requestLink;
        Mail::raw(
            $resetLink,
            function ($message) use ($email) {
                $message->to($email);
                $message->subject('Réinitialiser le mot de passe');});

        return "Une notification vous a été envoyé sur votre email !";
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function reset(ValidateTokenEmailPasswordRequest $request) : string
    {
        $reset = DB::table('password_reset_tokens')->where([
            ['token', $request->input('token')],
            ['email', $request->input('email')],
        ])->first();

        if (!$reset) {
            return 'email ou token invalide';
        }

        $user = User::where('email', $request->input('email'))->first();
        $user->password =  Hash::make(($request->input('password')));
        $user->save();


        DB::table('password_reset_tokens')->where(['email' => $request->input('email')])->delete();

        return "le mot de passe a été réinitialisé";
    }
}

