<?php

namespace Client\Http\Controllers;

use Admin\Http\Resources\Wallet\EmployeeWalletResource;
use Admin\Http\Resources\Wallet\CompanyWalletResource;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use Client\Foundations\Wallet\ClientCompanyWalletSearchCollection;
use Client\Foundations\Wallet\ClientEmployeeWalletSearchCollection;
use Illuminate\Http\Request;

class ClientWalletController extends Controller
{
    public function companyWallets(Request $request)
    {
        $wallets = ClientCompanyWalletSearchCollection::searchCompanyWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(CompanyWalletResource::collection($wallets));
    }

    public function employeeWallets(Request $request)
    {
        $wallets = ClientEmployeeWalletSearchCollection::searchEmployeeWallets(
            $request->get('company_id') ? $request->get('company_id') : -1,
            $request->get('employee_id') ? $request->get('employee_id') : -1,
            $request->get('date_from') ? $request->get('date_from') : -1,
            $request->get('date_to') ? $request->get('date_to') : -1,
            $request->get('sort') ? $request->get('sort') : SystemDefault::DEFAUL_SORT,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(EmployeeWalletResource::collection($wallets));
    }
}
