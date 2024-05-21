<?php

namespace Admin\Http\Controllers\Views\User;

use Admin\Foundations\User\UserSearchCollection;
use Admin\Http\Requests\User\UserCreateRequest;
use Admin\Http\Requests\User\UserUpdateRequest;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = UserSearchCollection::searchUsers(
            -1,
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/User/index', $data);
    }

    public function search(Request $request)
    {
        $data = UserSearchCollection::searchUsers(
            $request->get('user_account_type_id') ? $request->get('user_account_type_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

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
        $data['user_account_types'] = AccountTypeCollection::typeListExceptEmployeeAndClient();

        return view('Admin/User/create', $data);
    }

    public function store(UserCreateRequest $request)
    {
        User::create($request->validated());

        return redirect(url('admin/users'));
    }


    public function edit(User $user)
    {
        $data['user_account_types'] = AccountTypeCollection::typeListExceptEmployeeAndClient();
        $data['user'] = $user;

        return view('Admin/User/edit', $data);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = $request->validated();

        if (empty($validated['password'])) {

            unset($validated['password']);
        }

        $user->update($validated);

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
