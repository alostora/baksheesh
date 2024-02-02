<?php

namespace Client\Http\Controllers\Views;

use Admin\Foundations\Employee\EmployeeAvailableRating\EmployeeAvailableRatingCreateCollection;
use Admin\Foundations\Employee\EmployeeAvailableRating\EmployeeAvailableRatingSearchCollection;
use Admin\Foundations\Employee\EmployeeAvailableRating\EmployeeAvailableRatingUpdateCollection;
use Admin\Http\Requests\Company\CompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingCreateRequest;
use Admin\Http\Requests\Company\CompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingUpdateRequest;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Http\Controllers\Controller;
use App\Models\EmployeeAvailableRating;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeAvailableRatingController extends Controller
{
    public function index(Request $request)
    {
        $data = EmployeeAvailableRatingSearchCollection::searchEmployeeAvailableRatings(
            -1,
            -1,
            -1,
            -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/EmployeeAvailableRating/index', $data);
    }

    public function search(Request $request)
    {
        $data = EmployeeAvailableRatingSearchCollection::searchEmployeeAvailableRatings(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/EmployeeAvailableRating/index', $data);
    }

    public function create(User $user)
    {
        $data['employees'] = User::where('user_account_type_id', AccountTypeCollection::employee()->id)

            ->where('company_id', $user->company_id)

            ->where('stopped_at', null)

            ->get();

        return view('Client/EmployeeAvailableRating/create', $data);
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
