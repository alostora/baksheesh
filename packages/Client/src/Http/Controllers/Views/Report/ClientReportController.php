<?php

namespace Client\Http\Controllers\Views\Report;

use Client\Foundations\Report\Withdrawal\WithdrawalReportSearchCollection;
use Client\Foundations\Wallet\ClientCompanyWalletSearchCollection;
use Client\Foundations\Wallet\ClientEmployeeWalletSearchCollection;
use App\Constants\HasLookupType\UserAccountType;
use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Foundations\LookupType\WithdrawalRequestStatusCollection;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SystemLookup;
use App\Models\User;
use Illuminate\Http\Request;

class ClientReportController extends Controller
{
    public function companyWalletReport(Request $request)
    {
        $data['wallets'] = ClientCompanyWalletSearchCollection::searchCompanyWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $data['companies'] = Company::where('client_id', auth()->id())->get();

        return view('Client/Report/CompanyWallet/index', $data);
    }

    public function employeeWalletReport(Request $request)
    {
        $data['wallets'] = ClientEmployeeWalletSearchCollection::searchEmployeeWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $data['employees'] = User::where('client_id', auth()->id())
            ->where('stopped_at', null)
            ->get();

        $data['companies'] = Company::where('client_id', auth()->id())
            ->where('stopped_at', null)
            ->get();

        return view('Client/Report/EmployeeWallet/index', $data);
    }

    public function withdrawalRequestReport(Request $request)
    {
        $data['withdrawal_requests'] = WithdrawalReportSearchCollection::searcAllhWithdrawalRequests(

            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $data['withdrawal_request_status'] = WithdrawalRequestStatusCollection::statusList();

        return view('Client/Report/WithdrawalRequest/index', $data);
    }
}
