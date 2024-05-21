<?php

namespace Admin\Http\Controllers\Report;

use Admin\Foundations\Report\Client\ClientSearchCollection;
use Admin\Foundations\Report\Withdrawal\WithdrawalReportSearchCollection;
use Admin\Foundations\Wallet\CompanyWalletSearchCollection;
use Admin\Foundations\Wallet\EmployeeWalletSearchCollection;
use Admin\Http\Resources\Wallet\CompanyWalletResource;
use Admin\Http\Resources\Wallet\EmployeeWalletResource;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserMinifiedResource;
use Client\Http\Resources\ClientWithdrawalRequest\ClientWithdrawalRequestResource;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{

    public function companyWalletReport(Request $request)
    {
        $wallets = CompanyWalletSearchCollection::searchCompanyWallets(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyWalletResource::collection($wallets));
    }

    public function employeeWalletReport(Request $request)
    {
        $wallets = EmployeeWalletSearchCollection::searchEmployeeWallets(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(EmployeeWalletResource::collection($wallets));
    }


    public function withdrawalRequestReport(Request $request)
    {
        $delivered_cash = WithdrawalReportSearchCollection::searcAllhWithdrawalRequests(

            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ClientWithdrawalRequestResource::collection($delivered_cash));
    }

    public function inactiveClientReport(Request $request)
    {
        $clients = ClientSearchCollection::searchUsers(
            -1,
            -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(UserMinifiedResource::collection($clients));
    }

}
