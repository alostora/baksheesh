<?php

namespace App\Foundations\Auth;

use App\Models\User;

class RegisterCollection
{
    public static function register($validated)
    {
        $user =  User::create($validated);

        $user->api_token = $user->createToken(Request()->userAgent())->plainTextToken;

        $user->save();

        return $user;
    }
}
