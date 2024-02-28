<?php

namespace App\Http\Controllers;

use Client\Http\Requests\ClientCompany\CompanyAvailableRating\CompanyAvailableRatingMultiableCreateRequest;
use App\Foundations\Dashboard\DashboardClientCollection;
use App\Models\Company;
use Client\Foundations\ClientCompany\CompanyAvailableRating\CompanyAvailableRatingCreateCollection;
use Client\Foundations\ClientCompany\CompanyCreateCollection;
use Client\Foundations\ClientCompanyEmployee\ClientCompanyEmployeeCreateCollection;
use Client\Foundations\ClientCompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingCreateCollection;
use Client\Http\Requests\ClientCompany\ClientCompanyCreateRequest;
use Client\Http\Requests\ClientCompany\CompanyEmployee\ClientCompanyEmployee\ClientCompanyEmployeeCreateRequest;
use Client\Http\Requests\ClientCompany\CompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingMultiableCreateRequest;

class DashboardClientController extends Controller
{
    public function index()
    {
        $data = DashboardClientCollection::dashboardData();

        return view('Client/dashboard', $data);
    }

    //CompanyAvailableRating
    public function quickStartViewCreateCompanyAvailableRating()
    {
        if (auth()->user()->companyAvailableRatings->count() > 0) {

            return redirect(url('client/quick-start-create-employee-available-rating'));
        }

        return view('Client/QueckStart/CompanyAvailableRating/create');
    }

    public function quickStartCreateCompanyAvailableRating(CompanyAvailableRatingMultiableCreateRequest $request)
    {
        CompanyAvailableRatingCreateCollection::createCompanyAvailableRatingMultiable($request);

        return redirect(url('client/quick-start-create-employee-available-rating'));
    }
    //CompanyAvailableRating

    //EmployeeAvailableRating
    public function quickStartViewCreateEmployeeAvailableRating()
    {
        if (auth()->user()->employeeAvailableRatings->count() > 0) {

            return redirect(url('client/quick-start-create-company'));
        }
        return view('Client/QueckStart/EmployeeAvailableRating/create');
    }

    public function quickStartCreateEmployeeAvailableRating(EmployeeAvailableRatingMultiableCreateRequest $request)
    {
        EmployeeAvailableRatingCreateCollection::createEmployeeAvailableRatingMultiable($request);

        return redirect(url('client/quick-start-create-company'));
    }
    //EmployeeAvailableRating


    public function quickStartViewCreateCompany()
    {
        return view('Client/QueckStart/Company/create');
    }

    public function quickStartCreateCompany(ClientCompanyCreateRequest $request)
    {
        $company = CompanyCreateCollection::createCompany($request);

        return redirect(url('client/quick-start-create-employee/' . $company->id));
    }

    public function quickStartViewCreateEmployee(Company $company)
    {
        $data['company'] = $company;

        return view('Client/QueckStart/Employee/create', $data);
    }

    public function quickStartCreateEmployee(ClientCompanyEmployeeCreateRequest $request)
    {

        $employee = ClientCompanyEmployeeCreateCollection::createCompanyEmployee($request);

        if ($request->again == 1) {
            return back();
        }

        return redirect(url('client'));
    }
}
