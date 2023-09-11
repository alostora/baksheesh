<?php

namespace Admin\Http\Controllers\Views\User;

use Admin\Foundations\Client\ClientSearchCollection;
use Admin\Http\Requests\Client\ClientCreateRequest;
use Admin\Http\Requests\Client\ClientUpdateRequest;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $data['users'] = ClientSearchCollection::searchUsers(
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Client/index', $data);
    }

    public function search(Request $request)
    {
        $data['users'] = ClientSearchCollection::searchUsers(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Client/index', $data);
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
        return view('Admin/Client/create');
    }

    public function store(ClientCreateRequest $request)
    {
        $user_account_type = AccountTypeCollection::client();

        $validated = $request->validated();

        $validated['user_account_type_id'] = $user_account_type->id;

        User::create($validated);

        return redirect(url('admin/clients'));
    }

    public function edit(User $user)
    {
        $data['user'] = $user;

        return view('Admin/Client/edit', $data);
    }

    public function update(ClientUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect(url('admin/clients'));
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
