<?php

namespace App\Foundations\Auth;

use App\Models\User;

class LoginCollection
{
    public static function login($validated)
    {

        $user = User::where('phone', $validated['user'])->orWhere('email', $validated['user'])->first();

        $user->api_token = $user->createToken(Request()->userAgent())->plainTextToken;

        $user->save();

        return $user;
    }
}
