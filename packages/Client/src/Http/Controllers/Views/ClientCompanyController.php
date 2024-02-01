<?php

namespace Client\Http\Controllers\Views;

use Admin\Http\Resources\Company\CompanyResource;
use App\Constants\HasLookupType\AvailableCompanyRating;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SystemLookup;
use Carbon\Carbon;
use Client\Foundations\ClientCompany\ClientCompanySearchCollection;
use Client\Foundations\ClientCompany\CompanyCreateCollection;
use Client\Foundations\ClientCompany\CompanyUpdateCollection;
use Client\Http\Requests\ClientCompany\ClientCompanyCreateRequest;
use Client\Http\Requests\ClientCompany\ClientCompanyUpdateRequest;
use Illuminate\Http\Request;

class ClientCompanyController extends Controller
{
    public function index(Request $request)
    {
        $data = ClientCompanySearchCollection::searchCompanies(
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Company/index', $data);
    }

    public function search(Request $request)
    {
        $data = ClientCompanySearchCollection::searchCompanies(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Company/index', $data);
    }

    public function show(Company $company)
    {
        return response()->success(
            trans('company.company_retrieved_successfully'),
            new CompanyResource($company),
            StatusCode::OK
        );
    }

    public function create()
    {
        $data['available_rating'] = SystemLookup::where('type', AvailableCompanyRating::LOOKUP_TYPE)->get();

        return view('Client/Company/create', $data);
    }

    public function store(ClientCompanyCreateRequest $request)
    {

        CompanyCreateCollection::createCompany($request);

        return redirect(url('client/client-companies'));
    }

    public function edit(Company $company)
    {

        $data['company'] = $company;

        $selected_available_rating_ids = $company->companyAvailableRatings()->pluck('available_rating_id');

        $data['available_rating'] = SystemLookup::where('type', AvailableCompanyRating::LOOKUP_TYPE)
            ->whereNotIn('id', $selected_available_rating_ids)
            ->get();

        $data['selected_available_rating'] = SystemLookup::where('type', AvailableCompanyRating::LOOKUP_TYPE)
            ->whereIn('id', $selected_available_rating_ids)
            ->get();


        return view('Client/Company/edit', $data);
    }

    public function update(ClientCompanyUpdateRequest $request, Company $company)
    {
        CompanyUpdateCollection::updateCompany($request, $company);

        return redirect(url('client/client-companies'));
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
