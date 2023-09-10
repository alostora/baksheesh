<?php

namespace App\Http\Controllers;

use App\Constants\HasLookupType\UserAccountType;
use App\Constants\HasLookupType\WithdrawalRequestStatus;
use App\Models\ClientWithdrawalRequest;
use App\Models\Company;
use App\Models\CompanyCash;
use App\Models\EmployeeCash;
use App\Models\SystemLookup;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $client_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $employee_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::EMPLOYEE['code'])
            ->first();

        $data['count_active_clients'] = User::where('user_account_type_id', $client_type->id)
            ->where('stopped_at', null)->count();

        $data['count_active_employees'] = User::where('user_account_type_id', $employee_type->id)
            ->where('stopped_at', null)->count();

        $data['count_active_companies'] = Company::where('stopped_at', null)->count();


        $accepted_status = SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
            ->where('code', WithdrawalRequestStatus::ACCEPTED['code'])
            ->first();

        $delivered_withdrawal = ClientWithdrawalRequest::where('status', $accepted_status->id)
            ->sum('amount');

        $current_amount = (CompanyCash::sum('amount') + EmployeeCash::sum('amount')) - $delivered_withdrawal;

        $data['current_amount'] = $current_amount;

        return view('Admin/dashboard', $data);
    }
}
