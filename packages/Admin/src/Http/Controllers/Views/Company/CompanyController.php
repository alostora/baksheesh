<?php

namespace Admin\Http\Controllers\Views\Company;

use Admin\Foundations\Company\CompanyCreateCollection;
use Admin\Foundations\Company\CompanySearchCollection;
use Admin\Foundations\Company\CompanyUpdateCollection;
use Admin\Http\Requests\Company\CompanyCreateRequest;
use Admin\Http\Requests\Company\CompanyUpdateRequest;
use Admin\Http\Resources\Company\CompanyMinifiedResource;
use Admin\Http\Resources\Company\CompanyResource;
use App\Constants\HasLookupType\AvailableCompanyRating;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
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
        $data = CompanySearchCollection::searchCompanies(
            -1,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Company/index', $data);
    }

    public function search(Request $request)
    {
        $data = CompanySearchCollection::searchCompanies(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

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

    public function allCompanies(Request $request)
    {
        $companies = CompanySearchCollection::searchAllCompanies(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->success(
            trans('company.company_retrieved_successfully'),
            CompanyMinifiedResource::collection($companies),
            StatusCode::OK
        );
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
        $client_type = AccountTypeCollection::client();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        $data['available_rating'] = SystemLookup::where('type', AvailableCompanyRating::LOOKUP_TYPE)->get();

        return view('Admin/Company/create', $data);
    }

    public function store(CompanyCreateRequest $request)
    {
        CompanyCreateCollection::createCompany($request);

        return redirect(url('admin/companies'));
    }

    public function edit(Company $company)
    {
        $client_type = AccountTypeCollection::client();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        $data['company'] = $company;

        $selected_available_rating_ids = $company->companyAvailableRatings()->pluck('available_rating_id');

        $data['available_rating'] = SystemLookup::where('type', AvailableCompanyRating::LOOKUP_TYPE)
            ->whereNotIn('id', $selected_available_rating_ids)
            ->get();

        $data['selected_available_rating'] = SystemLookup::where('type', AvailableCompanyRating::LOOKUP_TYPE)
            ->whereIn('id', $selected_available_rating_ids)
            ->get();

        return view('Admin/Company/edit', $data);
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        CompanyUpdateCollection::updateCompany($request,$company);

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
