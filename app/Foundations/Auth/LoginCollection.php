<?php

namespace App\Foundations\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginCollection
{
    public static function login($validated)
    {

        $user = User::where('phone', $validated['user'])->orWhere('email', $validated['user'])->first();

        $user->api_token = $user->createToken(Request()->userAgent())->plainTextToken;

        if (isset($validated['finger_print'])) {

            $user->finger_print = $validated['finger_print'];
        }

        $user->save();

        return $user;
    }
}
