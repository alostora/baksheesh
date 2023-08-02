<?php

namespace Admin\Http\Controllers\Company;

use Admin\Foundations\Company\CompanySearchCollection;
use Admin\Http\Requests\Company\CompanyCreateRequest;
use Admin\Http\Requests\Company\CompanyUpdateRequest;
use Admin\Http\Resources\Company\CompanyMinifiedResourse;
use Admin\Http\Resources\Company\CompanyResourse;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = CompanySearchCollection::searchCompanies(
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyMinifiedResourse::collection($companies));
    }

    public function search(Request $request)
    {
        $companies = CompanySearchCollection::searchCompanies(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyMinifiedResourse::collection($companies));
    }

    public function show(Company $company)
    {
        return response()->success(
            trans('Company.Company_retrieved_successfully'),
            new CompanyResourse($company),
            StatusCode::OK
        );
    }

    public function store(CompanyCreateRequest $request)
    {
        $company = Company::create($request->validated());

        return response()->success(
            trans('Company.Company_created_successfully'),
            new CompanyResourse($company),
            StatusCode::OK
        );
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company->update($request->validated());

        return response()->success(
            trans('Company.Company_updated_successfully'),
            new CompanyResourse($company),
            StatusCode::OK
        );
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return response()->success(
            trans('Company.Company_deleted_successfully'),
            new CompanyResourse($company),
            StatusCode::OK
        );
    }
}
