<?php

namespace Client\Http\Controllers\Views;

use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\EmployeeAvailableRating;
use Carbon\Carbon;
use Client\Foundations\ClientCompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingCreateCollection;
use Client\Foundations\ClientCompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingSearchCollection;
use Client\Foundations\ClientCompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingUpdateCollection;
use Client\Http\Requests\ClientCompany\CompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingCreateRequest;
use Client\Http\Requests\ClientCompany\CompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingUpdateRequest;
use Illuminate\Http\Request;

class EmployeeAvailableRatingController extends Controller
{
    public function index(Request $request)
    {
        $data = EmployeeAvailableRatingSearchCollection::searchEmployeeAvailableRatings(
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/EmployeeAvailableRating/index', $data);
    }

    public function search(Request $request)
    {
        $data = EmployeeAvailableRatingSearchCollection::searchEmployeeAvailableRatings(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/EmployeeAvailableRating/index', $data);
    }

    public function create()
    {
        return view('Client/EmployeeAvailableRating/create');
    }

    public function store(EmployeeAvailableRatingCreateRequest $request)
    {
        EmployeeAvailableRatingCreateCollection::createEmployeeAvailableRating($request);

        return redirect(url("client/employee-available-ratings/search?employee_id=" . $request->get('employee_id')));
    }

    public function edit(EmployeeAvailableRating $employeeAvailableRating)
    {
        $data['employeeAvailableRating'] = $employeeAvailableRating;

        return view('Client/EmployeeAvailableRating/edit', $data);
    }

    public function update(EmployeeAvailableRatingUpdateRequest $request, EmployeeAvailableRating $employeeAvailableRating)
    {
        EmployeeAvailableRatingUpdateCollection::updateEmployeeAvailableRating($request, $employeeAvailableRating);

        return redirect(url("client/employee-available-ratings/search?company_id=" . $request->get('company_id')));
    }

    public function destroy(EmployeeAvailableRating $employeeAvailableRating)
    {
        $employeeAvailableRating->delete();

        return back();
    }

    public function active(EmployeeAvailableRating $employeeAvailableRating)
    {
        $employeeAvailableRating->update(['stopped_at' => null]);

        return back();
    }

    public function inactive(EmployeeAvailableRating $employeeAvailableRating)
    {
        $employeeAvailableRating->update(['stopped_at' => Carbon::now()]);

        return back();
    }
}
