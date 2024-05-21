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
use App\Constants\HasLookupType\CountryType;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\EmployeeAvailableRating;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CompanyEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = CompanyEmployeeSearchCollection::searchCompanyEmployees(
            -1,
            -1,
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/CompanyEmployee/index', $data);
    }

    public function search(Request $request)
    {
        $data = CompanyEmployeeSearchCollection::searchCompanyEmployees(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/CompanyEmployee/index', $data);
    }

    public function show(User $user)
    {
        return response()->success(
            trans('Company.company_employee_retrieved_successfully'),
            new CompanyEmployeeResource($user),
            StatusCode::OK
        );
    }

    public function create()
    {
        $client_type = AccountTypeCollection::client();

        // $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])
        //     ->where('stopped_at', null)
        //     ->get();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)
            ->where('stopped_at', null)
            ->get();

        return view('Admin/CompanyEmployee/create', $data);
    }


    public function clientEmployeeAvailableRatings(User $user)
    {

        $data['status'] = false;

        $data['available_rating'] = EmployeeAvailableRating::where('stopped_at', null)
            ->where('client_id', $user->id)->get();

        if (count($data['available_rating']) > 0) {
            $data['status'] = true;
        }

        return $data;
    }

    public function clientCompanies(User $user)
    {

        $data['status'] = false;

        $data['companies'] = Company::where('client_id', $user->id)

            ->where('client_id', $user->id)

            ->where('stopped_at', null)

            ->get();

        if (count($data['companies']) > 0) {
            $data['status'] = true;
        }

        return $data;
    }

    public function store(CompanyEmployeeCreateRequest $request)
    {
        $employee = CompanyEmployeeCreateCollection::createCompanyEmployee($request);

        if ($employee) {
            return redirect(url("admin/company-employees/search?company_id=" . $request->get('company_id')));
        } else {
            Session::flash('message', 'This is a message!');
            return back();
        }
    }

    public function edit(User $user)
    {
        $data['companies'] = Company::where('stopped_at', null)->get();

        $data['employee'] = $user;

        $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])
            ->where('stopped_at', null)
            ->get();

        $data['governorates'] = Country::where('country_id', $user->country_id)
            ->where('type', CountryType::GOVERNORATE['code'])
            ->where('stopped_at', null)
            ->get();


        $selected_available_rating_ids = $user->ratingForGuest()->pluck('available_rating_id');

        $data['selected_available_rating'] = EmployeeAvailableRating::where('stopped_at', null)
            ->whereIn('id', $selected_available_rating_ids)
            ->where('client_id', $user->client_id)
            ->get();

        $data['available_rating'] = EmployeeAvailableRating::where('stopped_at', null)
            ->whereNotIn('id', $selected_available_rating_ids)
            ->where('client_id', $user->client_id)
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
