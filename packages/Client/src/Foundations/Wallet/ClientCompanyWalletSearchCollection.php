<?php

namespace Client\Foundations\Wallet;

use App\Constants\SystemDefault;

class ClientCompanyWalletSearchCollection
{
    public static function searchCompanyWallets(
        $company_id = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = ClientCompanyWalletQueryCollection::searchAllCompanyWallets(
            $company_id,
            $date_from,
            $date_to,
        );

        return $companies->paginate($per_page);
    }
}
