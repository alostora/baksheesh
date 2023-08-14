<?php

namespace Guest\Http\Controllers;

use App\Constants\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\CompanyCash;
use App\Models\EmployeeCash;
use Guest\Http\Requests\PayForCompanyRequest;
use Guest\Http\Requests\PayForEmployeeRequest;
use Guest\Http\Resources\PayForCompanyResourse;
use Guest\Http\Resources\PayForEmployeeResourse;

class PaymentController extends Controller
{
    
    public function payForEmployee(PayForEmployeeRequest $request)
    {
        $employeeCash = EmployeeCash::create($request->validated());

        return response()->success(
            trans('payment.payment_created_successfully'),
            new PayForEmployeeResourse($employeeCash),
            StatusCode::OK
        );
    }
    
    public function payForCompany(PayForCompanyRequest $request)
    {
        $companyCash = CompanyCash::create($request->validated());

        return response()->success(
            trans('payment.payment_created_successfully'),
            new PayForCompanyResourse($companyCash),
            StatusCode::OK
        );
    }

}
