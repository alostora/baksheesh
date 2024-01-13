<?php

namespace Client\Http\Controllers;

use Admin\Http\Resources\Company\CompanyMinifiedResource;
use Admin\Http\Resources\Company\CompanyResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Carbon\Carbon;
use Client\Foundations\ClientCompany\ClientCompanySearchCollection;
use Client\Http\Requests\ClientCompany\ClientCompanyCreateApiRequest;
use Client\Http\Requests\ClientCompany\ClientCompanyUpdateApiRequest;
use Illuminate\Http\Request;

class ClientCompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = ClientCompanySearchCollection::searchCompanies(
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyMinifiedResource::collection($companies));
    }

    public function search(Request $request)
    {
        $companies = ClientCompanySearchCollection::searchCompanies(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyMinifiedResource::collection($companies));
    }

    public function show(Company $company)
    {
        return response()->success(
            trans('company.company_retrieved_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function store(ClientCompanyCreateApiRequest $request)
    {
        $validated = $request->validated();

        $validated['client_id'] = auth()->id();

        $company = Company::create($validated);

        return response()->success(
            trans('company.company_created_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function update(ClientCompanyUpdateApiRequest $request, Company $company)
    {
        $company->update($request->validated());

        return response()->success(
            trans('company.company_updated_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return response()->success(
            trans('company.company_deleted_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function active(Company $company)
    {
        $company->update(['stopped_at' => null]);

        return response()->success(
            trans('company.company_actived_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function inactive(Company $company)
    {
        $company->update(['stopped_at' => Carbon::now()]);

        return response()->success(
            trans('company.company_inactived_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }
}
