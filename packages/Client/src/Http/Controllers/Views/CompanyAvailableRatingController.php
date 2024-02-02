<?php

namespace Client\Http\Controllers\Views;

use Admin\Foundations\Company\CompanyAvailableRating\CompanyAvailableRatingCreateCollection;
use Admin\Foundations\Company\CompanyAvailableRating\CompanyAvailableRatingSearchCollection;
use Admin\Foundations\Company\CompanyAvailableRating\CompanyAvailableRatingUpdateCollection;
use Admin\Http\Requests\Company\CompanyAvailableRating\CompanyAvailableRatingCreateRequest;
use Admin\Http\Requests\Company\CompanyAvailableRating\CompanyAvailableRatingUpdateRequest;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyAvailableRating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyAvailableRatingController extends Controller
{
    public function index(Request $request)
    {
        $data = CompanyAvailableRatingSearchCollection::searchCompanyAvailableRatings(
            -1,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/CompanyAvailableRating/index', $data);
    }

    public function search(Request $request)
    {
        $data = CompanyAvailableRatingSearchCollection::searchCompanyAvailableRatings(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/CompanyAvailableRating/index', $data);
    }

    public function create(Company $company)
    {

        return view('Client/CompanyAvailableRating/create');
    }

    public function store(CompanyAvailableRatingCreateRequest $request)
    {
        CompanyAvailableRatingCreateCollection::createCompanyAvailableRating($request);

        return redirect(url("client/company-available-ratings/search?company_id=" . $request->get('company_id')));
    }

    public function edit(CompanyAvailableRating $companyAvailableRating)
    {
        $data['companyAvailableRating'] = $companyAvailableRating;

        return view('Client/CompanyAvailableRating/edit', $data);
    }

    public function update(CompanyAvailableRatingUpdateRequest $request, CompanyAvailableRating $companyAvailableRating)
    {
        CompanyAvailableRatingUpdateCollection::updateCompanyAvailableRating($request, $companyAvailableRating);

        return redirect(url("client/company-available-ratings/search?company_id=" . $request->get('company_id')));
    }

    public function destroy(CompanyAvailableRating $companyAvailableRating)
    {
        $companyAvailableRating->delete();

        return back();
    }

    public function active(CompanyAvailableRating $companyAvailableRating)
    {
        $companyAvailableRating->update(['stopped_at' => null]);

        return back();
    }

    public function inactive(CompanyAvailableRating $companyAvailableRating)
    {
        $companyAvailableRating->update(['stopped_at' => Carbon::now()]);

        return back();
    }
}
