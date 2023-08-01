<?php

namespace App\Http\Controllers\Auth;

use App\Constants\StatusCode;
use App\Foundations\Auth\ResetPasswordCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendResetPasswordRequest;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function sendResetPassword(SendResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $user->reset_password_code = rand(100000, 999999);

        $user->save();

        $user->sendResetPasswordCodeNotification();

        return response()->success(
            trans('auth.reset_password_code_sent_successfully'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = ResetPasswordCollection::resetPassword($request->validated());

        return response()->success(
            trans('auth.password_changed_successfully'),
            new UserMinifiedResource($user),
            StatusCode::OK
        );
    }
}
