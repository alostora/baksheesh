<?php

namespace Admin\Http\Controllers\Views\User;

use Admin\Foundations\Client\ClientCreateCollection;
use Admin\Foundations\Client\ClientSearchCollection;
use Admin\Foundations\Client\ClientUpdateCollection;
use Admin\Http\Requests\Client\ClientCreateRequest;
use Admin\Http\Requests\Client\ClientUpdateRequest;
use App\Constants\HasLookupType\CountryType;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use App\Models\Country;
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
        $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])
            ->where('stopped_at', null)
            ->get();

        return view('Admin/Client/create', $data);
    }

    public function store(ClientCreateRequest $request)
    {
        ClientCreateCollection::createClient($request);

        return redirect(url('admin/clients'));
    }

    public function edit(User $user)
    {
        $data['user'] = $user;
        
        $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])
            ->where('stopped_at', null)
            ->get();

        $data['governorates'] = Country::where('country_id', $user->country_id)
            ->where('type', CountryType::GOVERNORATE['code'])
            ->where('stopped_at', null)
            ->get();

        return view('Admin/Client/edit', $data);
    }

    public function update(ClientUpdateRequest $request, User $user)
    {
        ClientUpdateCollection::updateClient($request, $user);

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
