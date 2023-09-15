<?php

namespace Client\Http\Controllers\Views;

use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeMinifiedResource;
use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Carbon\Carbon;
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
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/CompanyEmployee/index', compact('employees'));
    }

    public function search(Request $request)
    {
        $employees = ClientCompanyEmployeeSearchCollection::searchCompanyEmployees(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/CompanyEmployee/index', compact('employees'));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('company.company_employee_retrieved_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function create(Request $request)
    {
        $data['company_id'] = $request->get('company_id');

        $data['companies'] = Company::where('client_id', auth()->id())->get();

        return view('Client/CompanyEmployee/create', $data);
    }

    public function store(ClientCompanyEmployeeCreateRequest $request)
    {
        ClientCompanyEmployeeCreateCollection::createCompanyEmployee($request);

        return redirect(url("client/client-company-employees/search?company_id=" . $request->get('company_id')));
    }
    public function edit(User $user)
    {
        $data['company_id'] = $user->company_id;

        $data['companies'] = Company::where('client_id', auth()->id())->get();

        $data['employee'] = $user;

        return view('Client/CompanyEmployee/edit', $data);
    }

    public function update(ClientCompanyEmployeeUpdateRequest $request, User $user)
    {
        $user = ClientCompanyEmployeeUpdateCollection::updateCompanyEmployee($request, $user);

        return redirect(url("client/client-company-employees/search?company_id=" . $request->get('company_id')));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
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

        $user->save();

        return response()->success(
            trans('company.company_employee_assigned_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
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
