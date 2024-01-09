<?php

namespace Client\Http\Controllers;

use Admin\Http\Resources\Wallet\CompanyWalletResource;
use Admin\Http\Resources\Wallet\EmployeeCashResource;
use Admin\Http\Resources\Wallet\EmployeeRatingResource;
use Admin\Http\Resources\Wallet\EmployeeWalletResource;
use Client\Foundations\Report\Withdrawal\WithdrawalReportSearchCollection;
use Client\Foundations\Wallet\ClientCompanyWalletSearchCollection;
use Client\Foundations\Wallet\ClientEmployeeWalletSearchCollection;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use Client\Foundations\Report\EmployeeNotes\EmployeeNotesReportSearchCollection;
use Client\Foundations\Report\EmployeeRating\EmployeeRatingReportSearchCollection;
use Client\Http\Resources\ClientWithdrawalRequest\ClientWithdrawalRequestResource;
use Illuminate\Http\Request;

class ClientReportController extends Controller
{
    public function companyWalletReport(Request $request)
    {
        $walletReports = ClientCompanyWalletSearchCollection::searchCompanyWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyWalletResource::collection($walletReports));
    }

    public function employeeWalletReport(Request $request)
    {
        $walletReports = ClientEmployeeWalletSearchCollection::searchEmployeeWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(EmployeeWalletResource::collection($walletReports));
    }

    public function withdrawalRequestReport(Request $request)
    {
        $withdrawalRequestReports = WithdrawalReportSearchCollection::searchAllWithdrawalRequests(

            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ClientWithdrawalRequestResource::collection($withdrawalRequestReports));
    }

    public function employeeRatingReport(Request $request)
    {

        $employeeRatings = EmployeeRatingReportSearchCollection::searchAllEmployeeRating(

            $request->get('rating_value') ? $request->get('rating_value') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(EmployeeRatingResource::collection($employeeRatings));
    }

    public function employeeNotesReport(Request $request)
    {

        $employeeNotes = EmployeeNotesReportSearchCollection::searchAllEmployeeNotes(

            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(EmployeeCashResource::collection($employeeNotes));
    }
}
