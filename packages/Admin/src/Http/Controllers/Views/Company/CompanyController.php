<?php

namespace Admin\Http\Controllers\Views\Company;

use Admin\Foundations\Company\CompanyCreateCollection;
use Admin\Foundations\Company\CompanySearchCollection;
use Admin\Foundations\Company\CompanyUpdateCollection;
use Admin\Http\Requests\Company\CompanyCreateRequest;
use Admin\Http\Requests\Company\CompanyUpdateRequest;
use Admin\Http\Resources\Company\CompanyMinifiedResource;
use Admin\Http\Resources\Company\CompanyResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyAvailableRating;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $data = CompanySearchCollection::searchCompanies(
            -1,
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
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
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
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
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
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
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
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
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
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

        $data['clients'] = User::where('user_account_type_id', $client_type->id)
            ->where('stopped_at', null)
            ->get();

        return view('Admin/Company/create', $data);
    }

    public function clientCompanyAvailableRatings(User $user)
    {

        $data['status'] = false;

        $data['available_rating'] = CompanyAvailableRating::where('stopped_at', null)
            ->where('client_id', $user->id)->get();

        if (count($data['available_rating']) > 0) {
            $data['status'] = true;
        }

        return $data;
    }

    public function store(CompanyCreateRequest $request)
    {
        $company = CompanyCreateCollection::createCompany($request);

        if ($company) {

            return redirect(url('admin/companies'));
        } else {
            Session::flash('error', Lang::get('company.You have the max count of companies'));
            return back();
        }
    }

    public function edit(Company $company)
    {
        $data['company'] = $company;

        $selected_available_rating_ids = $company->ratingForGuest()->pluck('available_rating_id');

        $data['selected_available_rating'] = CompanyAvailableRating::where('stopped_at', null)
            ->whereIn('id', $selected_available_rating_ids)
            ->where('client_id', $company->client_id)
            ->get();

        $data['available_rating'] = CompanyAvailableRating::where('stopped_at', null)
            ->where('client_id', $company->client_id)
            ->whereNotIn('id', $selected_available_rating_ids)
            ->get();

        return view('Admin/Company/edit', $data);
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        CompanyUpdateCollection::updateCompany($request, $company);

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
