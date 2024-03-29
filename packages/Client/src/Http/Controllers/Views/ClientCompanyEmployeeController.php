<?php

namespace Client\Http\Controllers\Views;

use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeResource;
use App\Constants\HasLookupType\CountryType;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\EmployeeAvailableRating;
use App\Models\User;
use Carbon\Carbon;
use Client\Foundations\ClientCompanyEmployee\AssignClientCompanyEmployeeCollection;
use Client\Foundations\ClientCompanyEmployee\ClientCompanyEmployeeCreateCollection;
use Client\Foundations\ClientCompanyEmployee\ClientCompanyEmployeeSearchCollection;
use Client\Foundations\ClientCompanyEmployee\ClientCompanyEmployeeUpdateCollection;
use Client\Http\Requests\ClientCompany\ClientCompanyEmployee\AssignClientCompanyEmployeeCreateRequest;
use Client\Http\Requests\ClientCompany\CompanyEmployee\ClientCompanyEmployee\ClientCompanyEmployeeCreateRequest;
use Client\Http\Requests\ClientCompany\CompanyEmployee\ClientCompanyEmployee\ClientCompanyEmployeeUpdateRequest;
use Illuminate\Http\Request;

class ClientCompanyEmployeeController extends Controller
{
    public function index(Request $request)
    {
        $data = ClientCompanyEmployeeSearchCollection::searchCompanyEmployees(
            -1,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/CompanyEmployee/index', $data);
    }

    public function search(Request $request)
    {
        $data = ClientCompanyEmployeeSearchCollection::searchCompanyEmployees(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/CompanyEmployee/index', $data);
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


        $data['available_rating'] = EmployeeAvailableRating::where('stopped_at', null)
            ->where('client_id', auth()->id())->get();

        // $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])
        //     ->where('stopped_at', null)
        //     ->get();

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

        $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])
            ->where('stopped_at', null)
            ->get();

        $data['governorates'] = Country::where('country_id', $user->country_id)
            ->where('type', CountryType::GOVERNORATE['code'])
            ->where('stopped_at', null)
            ->get();

        $data['employee'] = $user;

        $selected_available_rating_ids = $user->ratingForGuest()->pluck('available_rating_id');

        $data['selected_available_rating'] = EmployeeAvailableRating::where('stopped_at', null)
            ->whereIn('id', $selected_available_rating_ids)
            ->where('client_id', auth()->id())
            ->get();

        $data['available_rating'] = EmployeeAvailableRating::where('stopped_at', null)
            ->whereNotIn('id', $selected_available_rating_ids)
            ->where('client_id', auth()->id())
            ->get();

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
