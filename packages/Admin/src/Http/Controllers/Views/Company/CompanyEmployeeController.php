<?php

namespace Admin\Http\Controllers\Views\Company;

use Admin\Foundations\Company\CompanyEmployee\AssignCompanyEmployeeCollection;
use Admin\Foundations\Company\CompanyEmployee\CompanyEmployeeCreateCollection;
use Admin\Foundations\Company\CompanyEmployee\CompanyEmployeeSearchCollection;
use Admin\Foundations\Company\CompanyEmployee\CompanyEmployeeUpdateCollection;
use Admin\Http\Requests\Company\CompanyEmployee\AssignCompanyEmployeeCreateRequest;
use Admin\Http\Requests\Company\CompanyEmployee\CompanyEmployeeCreateRequest;
use Admin\Http\Requests\Company\CompanyEmployee\CompanyEmployeeUpdateRequest;
use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeResource;
use App\Constants\HasLookupType\AvailableEmployeeRating;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SystemLookup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = CompanyEmployeeSearchCollection::searchCompanyEmployees(
            -1,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/CompanyEmployee/index', compact('employees'));
    }

    public function search(Request $request)
    {
        $employees = CompanyEmployeeSearchCollection::searchCompanyEmployees(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/CompanyEmployee/index', compact('employees'));
    }

    public function show(User $user)
    {
        return response()->success(
            trans('Company.company_employee_retrieved_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function create(Request $request)
    {
        $data['company_id'] = $request->get('company_id');

        $data['companies'] = Company::get();

        $data['available_rating'] = SystemLookup::where('type', AvailableEmployeeRating::LOOKUP_TYPE)->get();

        return view('Admin/CompanyEmployee/create', $data);
    }

    public function store(CompanyEmployeeCreateRequest $request)
    {

        CompanyEmployeeCreateCollection::createCompanyEmployee($request);

        return redirect(url("admin/company-employees/search?company_id=" . $request->get('company_id')));
    }

    public function edit(User $user)
    {
        $data['company_id'] = $user->company_id;

        $data['companies'] = Company::get();

        $data['employee'] = $user;

        $selected_available_rating_ids = $user->EmployeeAvailableRatings()->pluck('available_rating_id');

        $data['available_rating'] = SystemLookup::where('type', AvailableEmployeeRating::LOOKUP_TYPE)
            ->whereNotIn('id', $selected_available_rating_ids)
            ->get();

        $data['selected_available_rating'] = SystemLookup::where('type', AvailableEmployeeRating::LOOKUP_TYPE)
            ->whereIn('id', $selected_available_rating_ids)
            ->get();

        return view('Admin/CompanyEmployee/edit', $data);
    }

    public function update(CompanyEmployeeUpdateRequest $request, User $user)
    {
        CompanyEmployeeUpdateCollection::updateCompanyEmployee($request, $user);

        return redirect(url("admin/company-employees/search?company_id=" . $request->get('company_id')));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }

    public function assigneCompanyEmployee(AssignCompanyEmployeeCreateRequest $request, User $user)
    {
        $user = AssignCompanyEmployeeCollection::assignCompanyEmployee($request, $user);

        return response()->success(
            trans('Company.company_employee_assigned_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function unassigneCompanyEmployee(User $user)
    {
        $user->company_id = null;

        $user->save();

        return response()->success(
            trans('Company.company_employee_assigned_successfully'),
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
