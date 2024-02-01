<?php

namespace App\Foundations\Dashboard;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Foundations\LookupType\WithdrawalRequestStatusCollection;
use App\Models\ClientWithdrawalRequest;
use App\Models\Company;
use App\Models\CompanyCash;
use App\Models\EmployeeCash;
use App\Models\User;
use Carbon\Carbon;

class DashboardCollection

{
    public static function dashboardData()
    {

        $data['count_active_clients'] = self::countActiveClients();

        $data['count_active_employees'] = self::countActiveEmployees();

        $data['count_active_companies'] = Company::where('stopped_at', null)->count();

        $data['month_income'] = self::monthIncome();

        $data['year_income'] = self::yearIncome();

        $data['current_amount'] = self::currentAmount();

        $data['mounth_income_chart'] = self::mounthIncomeChart();

        return $data;
    }

    public static function countActiveClients()
    {
        $client_type = AccountTypeCollection::client();

        return User::where('user_account_type_id', $client_type->id)
            ->where('stopped_at', null)->count();
    }

    public static function countActiveEmployees()
    {
        $employee_type = AccountTypeCollection::employee();

        return User::where('user_account_type_id', $employee_type->id)
            ->where('stopped_at', null)->count();
    }

    public static function monthIncome()
    {
        $company_cash = CompanyCash::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        $employee_cash = EmployeeCash::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        return $company_cash + $employee_cash;
    }

    public static function yearIncome()
    {
        $company_cash = CompanyCash::whereYear('created_at', Carbon::now()->year)->sum('amount');
        $employee_cash = EmployeeCash::whereYear('created_at', Carbon::now()->year)->sum('amount');

        return $company_cash + $employee_cash;
    }

    public static function currentAmount()
    {
        $accepted_status = WithdrawalRequestStatusCollection::accepted();

        $delivered_withdrawal = ClientWithdrawalRequest::where('status', $accepted_status->id)
            ->sum('amount');

        $company_cash = CompanyCash::sum('amount');
        $employee_cash = EmployeeCash::sum('amount');

        return ($company_cash + $employee_cash) - $delivered_withdrawal;
    }

    public static function mounthIncomeChart()
    {


        return CompanyCash::get()->groupBy('created_at');

        // ->groupBy(function($date) {
        //     return Carbon::parse($date->created_at)->format('M'); // grouping by years
        //     //return Carbon::parse($date->created_at)->format('m'); // grouping by months
        // });
    }
}
