<?php

namespace Admin\Http\Controllers\Employee;

use Admin\Foundations\Employee\EmployeeSearchCollection;
use Admin\Http\Resources\Company\CompanyEmployee\CompanyEmployeeMinifiedResource;
use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {

        $employees = EmployeeSearchCollection::searchEmployees(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
        );

        return response()->success(
            trans('employee.employee_retrieved_successfully'),
            CompanyEmployeeMinifiedResource::collection($employees),
            StatusCode::OK
        );
    }
}
