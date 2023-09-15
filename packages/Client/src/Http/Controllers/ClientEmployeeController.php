<?php

namespace Client\Http\Controllers;

use Client\Foundations\ClientEmployee\Employee\EmployeeSearchCollection;
use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeMinifiedResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Client\Foundations\ClientEmployee\ClientEmployeeCreateCollection;
use Client\Foundations\ClientEmployee\ClientEmployeeSearchCollection;
use Client\Foundations\ClientEmployee\ClientEmployeeUpdateCollection;
use Client\Http\Requests\ClientEmployee\ClientEmployeeUpdateRequest;
use Client\Http\Requests\ClientEmployee\ClientEmployeeCreateRequest;
use Client\Http\Resources\ClientEmployeeMinifiedResource;
use Client\Http\Resources\ClientEmployeeResource;
use Illuminate\Http\Request;

class ClientEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $companies = ClientEmployeeSearchCollection::searchEmployees(
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ClientEmployeeMinifiedResource::collection($companies));
    }

    public function search(Request $request)
    {
        $companies = ClientEmployeeSearchCollection::searchEmployees(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ClientEmployeeMinifiedResource::collection($companies));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('client.client_employee_retrieved_successfully'),
            new ClientEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function store(ClientEmployeeCreateRequest $request)
    {
        $user = ClientEmployeeCreateCollection::createClientEmployee($request);

        return response()->success(
            trans('client.client_employee_created_successfully'),
            new ClientEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function update(ClientEmployeeUpdateRequest $request, User $user)
    {
        $user = ClientEmployeeUpdateCollection::updateClientEmployee($request, $user);

        return response()->success(
            trans('client.client_employee_updated_successfully'),
            new ClientEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->success(
            trans('client.client_employee_deleted_successfully'),
            new ClientEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function active(User $user)
    {
        $user->update(['stopped_at' => null]);

        return response()->success(
            trans('client.client_employee_actived_successfully'),
            new ClientEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function inactive(User $user)
    {
        $user->update(['stopped_at' => Carbon::now()]);

        return response()->success(
            trans('client.client_employee_inactived_successfully'),
            new ClientEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function clientEmployees(Request $request)
    {

        $employees = EmployeeSearchCollection::searchEmployees(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
        );

        return response()->success(
            trans('employee.employee_retrieved_successfully'),
            CompanyEmployeeMinifiedResource::collection($employees),
            StatusCode::OK
        );
    }
}
