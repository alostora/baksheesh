<?php

namespace Client\Http\Controllers;

use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeMinifiedResource;
use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\User;
use Client\Foundations\ClientCompanyEmployee\AssignClientCompanyEmployeeCollection;
use Client\Foundations\ClientCompanyEmployee\ClientCompanyEmployeeCreateCollection;
use Client\Foundations\ClientCompanyEmployee\ClientCompanyEmployeeSearchCollection;
use Client\Foundations\ClientCompanyEmployee\ClientCompanyEmployeeUpdateCollection;
use Client\Http\Requests\ClientCompany\ClientCompanyEmployee\AssignClientCompanyEmployeeCreateRequest;
use Client\Http\Requests\ClientCompany\ClientCompanyEmployee\ClientCompanyEmployeeCreateRequest;
use Client\Http\Requests\ClientCompany\ClientCompanyEmployee\ClientCompanyEmployeeUpdateRequest;
use Illuminate\Http\Request;

class ClientCompanyEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = ClientCompanyEmployeeSearchCollection::searchCompanyEmployees(
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyEmployeeMinifiedResource::collection($employees));
    }

    public function search(Request $request)
    {
        $employees = ClientCompanyEmployeeSearchCollection::searchCompanyEmployees(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyEmployeeMinifiedResource::collection($employees));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('company.company_employee_retrieved_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function store(ClientCompanyEmployeeCreateRequest $request)
    {
        $user = ClientCompanyEmployeeCreateCollection::createCompanyEmployee($request);

        return response()->success(
            trans('company.company_employee_created_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function update(ClientCompanyEmployeeUpdateRequest $request, User $user)
    {
        $user = ClientCompanyEmployeeUpdateCollection::updateCompanyEmployee($request, $user);

        return response()->success(
            trans('company.company_employee_updated_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->success(
            trans('company.company_employee_deleted_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function assigneCompanyEmployee(AssignClientCompanyEmployeeCreateRequest $request, User $user)
    {
        $user = AssignClientCompanyEmployeeCollection::assignCompanyEmployee($request, $user);

        return response()->success(
            trans('company.company_employee_assigned_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function unassigneCompanyEmployee(User $user)
    {
        $user->company_id = null;

        return response()->success(
            trans('company.company_employee_assigned_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }
}
