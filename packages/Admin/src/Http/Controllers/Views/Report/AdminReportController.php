<?php

namespace Admin\Http\Controllers\Views\Report;

use Admin\Foundations\Report\Client\ClientSearchCollection;
use Admin\Foundations\Report\Withdrawal\WithdrawalReportSearchCollection;
use Admin\Foundations\Wallet\CompanyWalletSearchCollection;
use Admin\Foundations\Wallet\EmployeeWalletSearchCollection;
use App\Constants\HasLookupType\UserAccountType;
use App\Constants\HasLookupType\WithdrawalRequestStatus;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SystemLookup;
use App\Models\User;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function companyWalletReport(Request $request)
    {
        $data['wallets'] = CompanyWalletSearchCollection::searchCompanyWallets(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $client_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        $data['companies'] = Company::get();

        return view('Admin/Report/CompanyWallet/index', $data);
    }

    public function employeeWalletReport(Request $request)
    {
        $data['wallets'] = EmployeeWalletSearchCollection::searchEmployeeWallets(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $client_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $employee_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::EMPLOYEE['code'])
            ->first();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        $data['employees'] = User::where('user_account_type_id', $employee_type->id)->get();

        $data['companies'] = Company::get();

        return view('Admin/Report/EmployeeWallet/index', $data);
    }


    public function withdrawalRequestReport(Request $request)
    {
        $data['withdrawal_requests'] = WithdrawalReportSearchCollection::searcAllhWithdrawalRequests(

            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $client_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::CLIENT['code'])
            ->first();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        $data['withdrawal_request_status'] = SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)->get();


        return view('Admin/Report/WithdrawalRequest/index', $data);
    }

    public function inactiveClientReport(Request $request)
    {
        $data['users'] = ClientSearchCollection::searchUsers(
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('active') ? $request->get('active') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/Report/Client/index', $data);
    }
}
