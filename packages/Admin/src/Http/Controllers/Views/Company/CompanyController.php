<?php

namespace Admin\Http\Controllers\Views\Company;

use Admin\Foundations\Company\CompanySearchCollection;
use Admin\Http\Requests\Company\CompanyCreateRequest;
use Admin\Http\Requests\Company\CompanyUpdateRequest;
use Admin\Http\Resources\Company\CompanyResource;
use App\Constants\HasLookupType\UserAccountType;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SystemLookup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $data['companies'] = CompanySearchCollection::searchCompanies(
            -1,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $client_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        return view('Admin/Company/index', $data);
    }

    public function search(Request $request)
    {
        $data['companies'] = CompanySearchCollection::searchCompanies(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $client_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        return view('Admin/Company/index', $data);
    }

    public function clientCompanies(User $user, Request $request)
    {
        $companies = CompanySearchCollection::searchClientCompanies(
            $user,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Company/index', compact('companies'));
    }

    public function searchClientCompanies(User $user, Request $request)
    {
        $companies = CompanySearchCollection::searchClientCompanies(
            $user,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Company/index', compact('companies'));
    }

    public function show(Company $company)
    {
        return response()->success(
            trans('Company.Company_retrieved_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function create()
    {
        $client_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        return view('Admin/Company/create', $data);
    }

    public function store(CompanyCreateRequest $request)
    {
        Company::create($request->validated());

        return redirect(url('admin/companies'));
    }

    public function edit(Company $company)
    {
        $client_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        $data['company'] = $company;

        return view('Admin/Company/edit', $data);
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company->update($request->validated());

        return redirect(url('admin/companies'));
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return back();
    }

    public function active(Company $company)
    {
        $company->update(['stopped_at' => null]);

        return back();
    }

    public function inactive(Company $company)
    {
        $company->update(['stopped_at' => Carbon::now()]);

        return back();
    }
}
