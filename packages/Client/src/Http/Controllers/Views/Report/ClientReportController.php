<?php

namespace Client\Http\Controllers\Views\Report;

use Client\Foundations\Report\Withdrawal\WithdrawalReportSearchCollection;
use Client\Foundations\Wallet\ClientCompanyWalletSearchCollection;
use Client\Foundations\Wallet\ClientEmployeeWalletSearchCollection;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use Client\Foundations\Report\CompanyNotes\CompanyNotesReportSearchCollection;
use Client\Foundations\Report\CompanyRating\CompanyRatingReportSearchCollection;
use Client\Foundations\Report\EmployeeNotes\EmployeeNotesReportSearchCollection;
use Client\Foundations\Report\EmployeeRating\EmployeeRatingReportSearchCollection;
use Illuminate\Http\Request;

class ClientReportController extends Controller
{
    public function companyWalletReport(Request $request)
    {
        $data = ClientCompanyWalletSearchCollection::searchCompanyWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Report/CompanyWallet/index', $data);
    }

    public function companyRatingReport(Request $request)
    {

        $data = CompanyRatingReportSearchCollection::searchAllCompanyRating(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('rating_value') ? $request->get('rating_value') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Report/CompanyRating/index', $data);
    }

    public function companyNotesReport(Request $request)
    {

        $data = CompanyNotesReportSearchCollection::searchAllCompanyNotes(

            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Report/CompanyNotes/index', $data);
    }

    public function employeeWalletReport(Request $request)
    {
        $data = ClientEmployeeWalletSearchCollection::searchEmployeeWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Report/EmployeeWallet/index', $data);
    }

    public function withdrawalRequestReport(Request $request)
    {
        $data = WithdrawalReportSearchCollection::searchAllWithdrawalRequests(

            $request->get('status') ? $request->get('status') : -1,
            $request->get('amount') ? $request->get('amount') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Report/WithdrawalRequest/index', $data);
    }

    public function employeeRatingReport(Request $request)
    {

        $data = EmployeeRatingReportSearchCollection::searchAllEmployeeRating(

            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('rating_value') ? $request->get('rating_value') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Report/EmployeeRating/index', $data);
    }

    public function employeeNotesReport(Request $request)
    {

        $data = EmployeeNotesReportSearchCollection::searchAllEmployeeNotes(

            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('query_string') ? $request->get('query_string') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Client/Report/EmployeeNotes/index', $data);
    }
}
