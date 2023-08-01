<?php

namespace App\Http\Controllers\Auth;

use App\Constants\StatusCode;
use App\Foundations\Auth\UpdateProfileCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\Auth\UserResource;

class ProfileController extends Controller
{

    public function show()
    {
        return response()->success(
            trans('auth.profile_retrieved_successfully'),
            new UserResource(auth()->user()),
            StatusCode::OK
        );
    }

    public function update(UpdateProfileRequest $request)
    {

        $user = UpdateProfileCollection::updateProfile($request->validated());

        return response()->success(
            trans('auth.profile_updated_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }
}
