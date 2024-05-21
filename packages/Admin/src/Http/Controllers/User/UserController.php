<?php

namespace Admin\Http\Controllers\User;

use Admin\Foundations\User\UserSearchCollection;
use Admin\Http\Requests\User\UserCreateRequest;
use Admin\Http\Requests\User\UserUpdateRequest;
use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = UserSearchCollection::searchUsers(
            -1,
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(UserMinifiedResource::collection($users));
    }

    public function search(Request $request)
    {
        $users = UserSearchCollection::searchUsers(
            $request->get('user_account_type_id') ? $request->get('user_account_type_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(UserMinifiedResource::collection($users));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('user.user_retrieved_successfully'),
            new CompanyEmployeeResource($user),
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

        $validated = $request->validated();

        if (empty($validated['password'])) {

            unset($validated['password']);
        }

        $user->update($validated);

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

    public function active(User $user)
    {
        $user->update(['stopped_at' => null]);

        return response()->success(
            trans('user.user_employee_actived_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }

    public function inactive(User $user)
    {
        $user->update(['stopped_at' => Carbon::now()]);

        return response()->success(
            trans('user.user_employee_inactived_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }
}
