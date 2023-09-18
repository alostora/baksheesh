<?php

namespace Guest\Http\Controllers;

use App\Constants\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\CompanyCash;
use App\Models\EmployeeCash;
use Guest\Http\Requests\PayForCompanyRequest;
use Guest\Http\Requests\PayForEmployeeRequest;
use Guest\Http\Resources\PayForCompanyResource;
use Guest\Http\Resources\PayForEmployeeResource;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function payForEmployee(PayForEmployeeRequest $request)
    {

        return $request->all();
        $employeeCash = EmployeeCash::create($request->validated());

        return response()->success(
            trans('payment.payment_created_successfully'),
            new PayForEmployeeResource($employeeCash),
            StatusCode::OK
        );
    }

    public function payForCompany(PayForCompanyRequest $request)
    {
        $companyCash = CompanyCash::create($request->validated());

        return response()->success(
            trans('payment.payment_created_successfully'),
            new PayForCompanyResource($companyCash),
            StatusCode::OK
        );
    }
}
