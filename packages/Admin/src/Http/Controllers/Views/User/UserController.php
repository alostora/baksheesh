<?php

namespace Admin\Http\Controllers\Views\User;

use Admin\Foundations\User\UserSearchCollection;
use Admin\Http\Requests\User\UserCreateRequest;
use Admin\Http\Requests\User\UserUpdateRequest;
use App\Constants\HasLookupType\UserAccountType;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use App\Models\SystemLookup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data['users'] = UserSearchCollection::searchUsers(
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $data['user_account_types'] = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code', '!=', UserAccountType::EMPLOYEE['code'])
            ->get();

        return view('Admin/User/index', $data);
    }

    public function search(Request $request)
    {
        $data['users'] = UserSearchCollection::searchUsers(
            $request->get('user_account_type_id') ? $request->get('user_account_type_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $data['user_account_types'] = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code', '!=', UserAccountType::EMPLOYEE['code'])
            ->get();

        return view('Admin/User/index', $data);
    }

    public function show(User $user)
    {
        return response()->success(
            trans('user.user_retrieved_successfully'),
            new UserResource($user),
            StatusCode::OK
        );
    }

    public function create()
    {
        $data['user_account_types'] = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code', '!=', UserAccountType::EMPLOYEE['code'])
            ->get();

        return view('Admin/User/create', $data);
    }

    public function store(UserCreateRequest $request)
    {
        User::create($request->validated());

        return redirect(url('admin/users'));
    }


    public function edit(User $user)
    {
        $data['user_account_types'] = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code', '!=', UserAccountType::EMPLOYEE['code'])
            ->get();

        $data['user'] = $user;

        return view('Admin/User/edit', $data);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect(url('admin/users'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }

    public function active(User $user)
    {
        $user->update(['stopped_at' => null]);

        return back();
    }

    public function inactive(User $user)
    {
        $user->update(['stopped_at' => Carbon::now()]);

        return back();
    }
}
