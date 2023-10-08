<?php

namespace Guest\Http\Controllers\Views;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyCash;
use App\Models\EmployeeCash;
use App\Models\SystemLookup;
use App\Models\User;
use Guest\Http\Requests\PayForCompanyRequest;
use Guest\Http\Requests\PayForEmployeeRequest;

class ReviewController extends Controller
{

    public function payForCompany(PayForCompanyRequest $request)
    {
        CompanyCash::create($request->validated());

        return back();
    }

    public function payForEmployee(PayForEmployeeRequest $request)
    {
        EmployeeCash::create($request->validated());

        return back();
    }


    public function viewPaymentForEmployee(User $user)
    {
        $employee_available_ratings = $user->employeeAvailableRatings()->pluck('available_rating_id');

        $data['employee_available_ratings'] = SystemLookup::whereIn('id', $employee_available_ratings)->get();

        $data['employee'] = $user;

        return view('Guest/EmployeePayment/paymentForEmployee', $data);
    }

    public function viewPaymentForCompany(Company $company)
    {
        $company_available_ratings = $company->companyAvailableRatings()->pluck('available_rating_id');

        $data['company_available_ratings'] = SystemLookup::whereIn('id', $company_available_ratings)->get();

        $data['company'] = $company;

        return view('Guest/CompanyPayment/paymentForCompany', $data);
    }
}
