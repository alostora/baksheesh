<?php

namespace Client\Foundations\Wallet;

use App\Constants\SystemDefault;
use App\Models\Company;
use App\Models\CompanyCash;

class ClientCompanyWalletSearchCollection
{
    public static function searchCompanyWallets(
        $company_id = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['wallets'] = ClientCompanyWalletQueryCollection::searchAllCompanyWallets(
            $company_id,
            $date_from,
            $date_to,
        )->paginate($per_page);

        $data['companies'] = Company::where('client_id', auth()->id())->where('stopped_at', null)->get();


        $data['count_total'] = CompanyCash::where('client_id', auth()->id())

            ->where('amount', '>', 0)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->sum('amount');

        return $data;
    }
}
