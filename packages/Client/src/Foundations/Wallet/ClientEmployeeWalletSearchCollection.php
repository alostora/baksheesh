<?php

namespace Client\Foundations\Wallet;

use App\Constants\SystemDefault;

class ClientEmployeeWalletSearchCollection
{
    public static function searchEmployeeWallets(
        $company_id = -1,
        $employee_id = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = ClientEmployeeWalletQueryCollection::searchAllEmployeeWallets(
            $company_id,
            $employee_id,
            $date_from,
            $date_to,
        );

        return $companies->paginate($per_page);
    }
    
}
