<?php

namespace Admin\Foundations\Wallet;

use App\Constants\SystemDefault;

class CompanyWalletSearchCollection
{
    public static function searchCompanyWallets(
        $client_id = -1,
        $company_id = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = CompanyWalletQueryCollection::searchAllCompanyWallets(
            $client_id,
            $company_id,
            $date_from,
            $date_to,
        );

        return $companies->paginate($per_page);
    }
}
