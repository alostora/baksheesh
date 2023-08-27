<?php

namespace Admin\Http\Controllers\Company;

use Admin\Foundations\Company\CompanySearchCollection;
use Admin\Http\Requests\Company\CompanyCreateRequest;
use Admin\Http\Requests\Company\CompanyUpdateRequest;
use Admin\Http\Resources\Company\CompanyMinifiedResource;
use Admin\Http\Resources\Company\CompanyResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = CompanySearchCollection::searchCompanies(
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyMinifiedResource::collection($companies));
    }

    public function search(Request $request)
    {
        $companies = CompanySearchCollection::searchCompanies(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyMinifiedResource::collection($companies));
    }

    public function clientCompanies(User $user, Request $request)
    {
        $companies = CompanySearchCollection::searchClientCompanies(
            $user,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyMinifiedResource::collection($companies));
    }

    public function searchClientCompanies(User $user, Request $request)
    {
        $companies = CompanySearchCollection::searchClientCompanies(
            $user,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyMinifiedResource::collection($companies));
    }

    public function show(Company $company)
    {
        return response()->success(
            trans('Company.Company_retrieved_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function store(CompanyCreateRequest $request)
    {
        $company = Company::create($request->validated());

        return response()->success(
            trans('Company.Company_created_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company->update($request->validated());

        return response()->success(
            trans('Company.Company_updated_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return response()->success(
            trans('Company.Company_deleted_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }
}
