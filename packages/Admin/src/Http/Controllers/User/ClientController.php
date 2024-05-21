<?php

namespace Admin\Http\Controllers\User;

use Admin\Foundations\Client\ClientSearchCollection;
use Admin\Http\Requests\Client\ClientCreateRequest;
use Admin\Http\Requests\Client\ClientUpdateRequest;
use App\Constants\HasLookupType\UserAccountType;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserMinifiedResource;
use App\Http\Resources\Auth\UserResource;
use App\Models\SystemLookup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $users = ClientSearchCollection::searchUsers(
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(UserMinifiedResource::collection($users));
    }

    public function search(Request $request)
    {
        $users = ClientSearchCollection::searchUsers(
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
            new UserResource($user),
            StatusCode::OK
        );
    }

    public function store(ClientCreateRequest $request)
    {
        $user_account_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $validated = $request->validated();

        $validated['user_account_type_id'] = $user_account_type->id;

        $user = User::create($validated);

        return response()->success(
            trans('user.user_created_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }

    public function update(ClientUpdateRequest $request, User $user)
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
