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

class DashboardClientCollection

{
    public static function dashboardData()
    {
        $data['count_active_employees'] = self::countActiveEmployees();

        $data['count_active_companies'] = Company::where('client_id', auth()->id())
            ->where('stopped_at', null)
            ->count();

        $data['month_income'] = self::monthIncome();

        $data['year_income'] = self::yearIncome();

        $data['current_amount'] = self::currentAmount();

        return $data;
    }

    public static function countActiveEmployees()
    {
        $employee_type = AccountTypeCollection::employee();

        return User::where('user_account_type_id', $employee_type->id)
            ->where('client_id', auth()->id())
            ->where('stopped_at', null)
            ->count();
    }

    public static function monthIncome()
    {
        $company_cash = CompanyCash::where('client_id', auth()->id())
            ->whereYear('created_at', Carbon::now()->endOfYear()->year)
            ->whereMonth('created_at', Carbon::now()->endOfMonth()->month)->get();

        $employee_cash = EmployeeCash::where('client_id', auth()->id())
            ->whereYear('created_at', Carbon::now()->endOfYear()->year)
            ->whereMonth('created_at', Carbon::now()->endOfMonth()->month)->get();

        return $company_cash->sum('net_amount') + $employee_cash->sum('net_amount');
    }

    public static function yearIncome()
    {
        $company_cash = CompanyCash::where('client_id', auth()->id())
            ->whereYear('created_at', Carbon::now()->endOfYear()->year)->get();

        $employee_cash = EmployeeCash::where('client_id', auth()->id())
            ->whereYear('created_at', Carbon::now()->endOfYear()->year)->get();

        return $company_cash->sum('net_amount') + $employee_cash->sum('net_amount');
    }

    public static function currentAmount()
    {
        $accepted_status = WithdrawalRequestStatusCollection::accepted();

        $delivered_withdrawal = ClientWithdrawalRequest::where('client_id', auth()->id())
            ->where('status', $accepted_status->id)
            ->sum('amount');

        $company_cash = CompanyCash::where('client_id', auth()->id())->get();
        $employee_cash = EmployeeCash::where('client_id', auth()->id())->get();

        return ($company_cash->sum('net_amount') + $employee_cash->sum('net_amount')) - $delivered_withdrawal;
    }
}
