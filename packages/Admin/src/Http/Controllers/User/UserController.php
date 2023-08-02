<?php

namespace Admin\Http\Controllers\User;

use Admin\Foundations\User\UserSearchCollection;
use Admin\Http\Requests\User\UserCreateRequest;
use Admin\Http\Requests\User\UserUpdateRequest;
use Admin\Http\Resources\User\UserMinifiedResource;
use Admin\Http\Resources\User\UserResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = UserSearchCollection::searchUsers(
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(UserMinifiedResource::collection($users));
    }

    public function search(Request $request)
    {
        $users = UserSearchCollection::searchUsers(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(UserMinifiedResource::collection($users));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('user.user_retrieved_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create($request->validated());

        return response()->success(
            trans('user.user_created_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->success(
            trans('user.user_updated_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->success(
            trans('user.user_deleted_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }
}
