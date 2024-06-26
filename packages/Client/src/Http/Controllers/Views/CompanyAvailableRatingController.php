<?php

namespace Client\Http\Controllers\Views;

use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\CompanyAvailableRating;
use Carbon\Carbon;
use Client\Foundations\ClientCompany\CompanyAvailableRating\CompanyAvailableRatingCreateCollection;
use Client\Foundations\ClientCompany\CompanyAvailableRating\CompanyAvailableRatingSearchCollection;
use Client\Foundations\ClientCompany\CompanyAvailableRating\CompanyAvailableRatingUpdateCollection;
use Client\Http\Requests\ClientCompany\CompanyAvailableRating\CompanyAvailableRatingCreateRequest;
use Client\Http\Requests\ClientCompany\CompanyAvailableRating\CompanyAvailableRatingUpdateRequest;
use Illuminate\Http\Request;

class CompanyAvailableRatingController extends Controller
{
    public function index(Request $request)
    {
        $data = CompanyAvailableRatingSearchCollection::searchCompanyAvailableRatings(
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/CompanyAvailableRating/index', $data);
    }

    public function search(Request $request)
    {
        $data = CompanyAvailableRatingSearchCollection::searchCompanyAvailableRatings(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/CompanyAvailableRating/index', $data);
    }

    public function create()
    {
        return view('Client/CompanyAvailableRating/create');
    }

    public function store(CompanyAvailableRatingCreateRequest $request)
    {
        CompanyAvailableRatingCreateCollection::createCompanyAvailableRating($request);

        return redirect(url("client/company-available-ratings/search"));
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
