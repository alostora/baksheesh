<?php

namespace Admin\Foundations\Wallet;

use App\Constants\SystemDefault;

class EmployeeWalletSearchCollection
{
    public static function searchEmployeeWallets(
        $client_id = -1,
        $company_id = -1,
        $employee_id = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = EmployeeWalletQueryCollection::searchAllEmployeeWallets(
            $client_id,
            $company_id,
            $employee_id,
            $date_from,
            $date_to,
        );

        return $companies->paginate($per_page);
    }
    
}
