<?php

namespace Client\Http\Controllers\Views;

use Admin\Http\Resources\Company\CompanyResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Carbon\Carbon;
use Client\Foundations\ClientCompany\ClientCompanySearchCollection;
use Client\Http\Requests\ClientCompany\ClientCompanyCreateRequest;
use Client\Http\Requests\ClientCompany\ClientCompanyUpdateRequest;
use Illuminate\Http\Request;

class ClientCompanyController extends Controller
{
    public function index(Request $request)
    {
        $data['companies'] = ClientCompanySearchCollection::searchCompanies(
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Company/index', $data);
    }

    public function search(Request $request)
    {
        $data['companies']  = ClientCompanySearchCollection::searchCompanies(
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
        return view('Client/Company/create');
    }

    public function store(ClientCompanyCreateRequest $request)
    {
        $validated = $request->validated();

        $validated['client_id'] = auth()->id();

        Company::create($validated);

        return redirect(url('client/client-companies'));
    }

    public function edit(Company $company)
    {
        $data['company'] = $company;

        return view('Client/Company/edit', $data);
    }

    public function update(ClientCompanyUpdateRequest $request, Company $company)
    {
        $company->update($request->validated());

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
