<?php

namespace Admin\Http\Controllers\Views\Wallet;

use Admin\Foundations\Wallet\CompanyWalletSearchCollection;
use Admin\Foundations\Wallet\EmployeeWalletSearchCollection;
use App\Constants\HasLookupType\UserAccountType;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SystemLookup;
use App\Models\User;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function companyWallets(Request $request)
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

        return view('Admin/CompanyWallet/index', $data);
    }

    public function employeeWallets(Request $request)
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

        return view('Admin/EmployeeWallet/index', $data);
    }
}
