<?php

namespace App\Http\Controllers\Auth;

use App\Constants\StatusCode;
use App\Foundations\Auth\LoginCollection;
use App\Foundations\Auth\RegisterCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = LoginCollection::login($request->validated());

        return response()->success(
            trans('auth.logged_in_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }

    public function register(RegisterRequest $request)
    {
        $user = RegisterCollection::register($request->validated());

        return response()->success(
            trans('auth.registered_successfully'),
            new UserMinifiedResource($user),
            StatusCode::CREATED
        );
    }

    public function show()
    {
        return response()->success(
            trans('auth.profile_retrieved_successfully'),
            new UserMinifiedResource(auth()->user()),
            StatusCode::OK
        );
    }

    public function logout(Request $request)
    {

        //delete this device only
        //$request->user()->currentAccessToken()->delete();

        //delete from all devices
        $request->user()->tokens()->delete();

        $request->user()->update(['api_token' => null]);

        return response()->success(
            trans('auth.logged_out_successfully'),
            [],
            StatusCode::OK
        );
    }
}
