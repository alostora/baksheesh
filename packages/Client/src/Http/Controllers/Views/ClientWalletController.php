<?php

namespace Client\Http\Controllers\Views;

use Admin\Http\Resources\Wallet\EmployeeWalletResource;
use Admin\Http\Resources\Wallet\CompanyWalletResource;
use App\Constants\HasLookupType\UserAccountType;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\SystemLookup;
use App\Models\User;
use Client\Foundations\Wallet\ClientCompanyWalletSearchCollection;
use Client\Foundations\Wallet\ClientEmployeeWalletSearchCollection;
use Illuminate\Http\Request;

class ClientWalletController extends Controller
{
    public function companyWallets(Request $request)
    {
        $data['wallets'] = ClientCompanyWalletSearchCollection::searchCompanyWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $data['companies'] = Company::where('client_id', auth()->id())->get();

        return view('Client/CompanyWallet/index', $data);
    }

    public function employeeWallets(Request $request)
    {
        $data['wallets'] = ClientEmployeeWalletSearchCollection::searchEmployeeWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        $employee_type = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code',  UserAccountType::EMPLOYEE['code'])
            ->first();

        $data['employees'] = User::where('client_id', auth()->id())->where('user_account_type_id', $employee_type->id)->get();

        $data['companies'] = Company::where('client_id', auth()->id())->get();

        return view('Client/EmployeeWallet/index', $data);
    }
}
