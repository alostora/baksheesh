<?php

namespace Client\Foundations\Wallet;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\EmployeeCash;
use App\Models\User;

class ClientEmployeeWalletSearchCollection
{
    public static function searchEmployeeWallets(
        $company_id = -1,
        $employee_id = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['wallets'] = ClientEmployeeWalletQueryCollection::searchAllEmployeeWallets(
            $company_id,
            $employee_id,
            $date_from,
            $date_to,
        )->paginate($per_page);

        $data['employees'] = User::where('user_account_type_id', AccountTypeCollection::employee()->id)->get();

        $data['companies'] = Company::get();

        $data['count_total'] = EmployeeCash::where('client_id', auth()->id())

            ->where('amount', '>', 0)

            ->where(function ($q) use ($company_id, $employee_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($employee_id && $employee_id != -1) {

                    $q
                        ->where('employee_id', $employee_id);
                }
            })->sum('amount');

        return $data;
    }
}
