<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\SystemLookup;
use Illuminate\Http\Request;

class PaymentForCompanyController extends Controller
{

    public function index(Company $company)
    {
        $company_available_ratings = $company->companyAvailableRatings()->pluck('available_rating_id');

        $data['company_available_ratings'] = SystemLookup::whereIn('id', $company_available_ratings)->get();

        return view('Guest/CompanyPayment/paymentForCompany', $data);
    }
}
