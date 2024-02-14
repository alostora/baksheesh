<?php

namespace App\Http\Controllers;

use Admin\Foundations\Client\ClientCreateCollection;
use Admin\Foundations\Company\CompanyAvailableRating\CompanyAvailableRatingCreateCollection;
use Admin\Foundations\Company\CompanyCreateCollection;
use Admin\Foundations\Company\CompanyEmployee\CompanyEmployeeCreateCollection;
use Admin\Foundations\Employee\EmployeeAvailableRating\EmployeeAvailableRatingCreateCollection;
use Admin\Http\Requests\Client\ClientCreateRequest;
use Admin\Http\Requests\Company\CompanyAvailableRating\CompanyAvailableRatingMultiableCreateRequest;
use Admin\Http\Requests\Company\CompanyCreateRequest;
use Admin\Http\Requests\Company\CompanyEmployee\CompanyEmployeeCreateRequest;
use Admin\Http\Requests\Company\CompanyEmployee\EmployeeAvailableRating\EmployeeAvailableRatingMultiableCreateRequest;
use App\Constants\HasLookupType\CountryType;
use App\Foundations\Dashboard\DashboardCollection;
use App\Models\Company;
use App\Models\Country;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = DashboardCollection::dashboardData();

        return view('Admin/dashboard', $data);
    }


    //Client
    public function quickStartViewCreateClient()
    {

        $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])
            ->where('stopped_at', null)
            ->get();

        return view('Admin/QueckStart/Client/create', $data);
    }

    public function quickStartCreateClient(ClientCreateRequest $request)
    {

        $client = ClientCreateCollection::createClient($request);

        return redirect(url('admin/quick-start-create-company-available-rating/' . $client->id));
    }
    //Client


    //CompanyAvailableRating
    public function quickStartViewCreateCompanyAvailableRating(User $user)
    {
        $data['client'] = $user;

        return view('Admin/QueckStart/CompanyAvailableRating/create', $data);
    }

    public function quickStartCreateCompanyAvailableRating(CompanyAvailableRatingMultiableCreateRequest $request)
    {

        CompanyAvailableRatingCreateCollection::createCompanyAvailableRatingMultiable($request);

        return redirect(url('admin/quick-start-create-employee-available-rating/' . $request->client_id));
    }
    //CompanyAvailableRating

    //EmployeeAvailableRating
    public function quickStartViewCreateEmployeeAvailableRating(User $user)
    {
        $data['client'] = $user;

        return view('Admin/QueckStart/EmployeeAvailableRating/create', $data);
    }

    public function quickStartCreateEmployeeAvailableRating(EmployeeAvailableRatingMultiableCreateRequest $request)
    {

        EmployeeAvailableRatingCreateCollection::createEmployeeAvailableRatingMultiable($request);

        return redirect(url('admin/quick-start-create-company/' . $request->client_id));
    }
    //EmployeeAvailableRating


    public function quickStartViewCreateCompany(User $user)
    {
        $data['client'] = $user;

        return view('Admin/QueckStart/Company/create', $data);
    }

    public function quickStartCreateCompany(CompanyCreateRequest $request)
    {
        $company = CompanyCreateCollection::createCompany($request);

        return redirect(url('admin/quick-start-create-employee/' . $company->id));
    }

    public function quickStartViewCreateEmployee(Company $company)
    {
        $data['company'] = $company;

        return view('Admin/QueckStart/Employee/create', $data);
    }

    public function quickStartCreateEmployee(CompanyEmployeeCreateRequest $request)
    {
        $employee = CompanyEmployeeCreateCollection::createCompanyEmployee($request);

        return redirect(url('admin'));
    }
}
