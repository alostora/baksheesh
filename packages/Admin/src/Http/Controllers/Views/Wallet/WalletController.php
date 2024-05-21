<?php

namespace Admin\Http\Controllers\Views\Wallet;

use Admin\Foundations\Wallet\CompanyWalletSearchCollection;
use Admin\Foundations\Wallet\EmployeeWalletSearchCollection;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function companyWallets(Request $request)
    {
        $data = CompanyWalletSearchCollection::searchCompanyWallets(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/CompanyWallet/index', $data);
    }

    public function employeeWallets(Request $request)
    {
        $data = EmployeeWalletSearchCollection::searchEmployeeWallets(
            $request->get('client_id') ? $request->get('client_id') : -1,
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return view('Admin/EmployeeWallet/index', $data);
    }
}
