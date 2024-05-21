<?php

namespace Client\Foundations\Wallet;

use App\Constants\SystemDefault;
use App\Models\Company;

class ClientCompanyWalletSearchCollection
{
    public static function searchCompanyWallets(
        $company_id = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['wallets'] = ClientCompanyWalletQueryCollection::searchAllCompanyWallets(
            $company_id,
            $date_from,
            $date_to,
            $sort,
        )->paginate($per_page);

        $data['companies'] = Company::where('client_id', auth()->id())->where('stopped_at', null)->get();

        //above table label info
        $data['count_total'] = ClientCompanyWalletQueryCollection::sumCompanyCashAmount($company_id);

        //print
        $data['all_companies_amount'] = ClientCompanyWalletQueryCollection::printAllCompaniesAmount();

        if ($company_id && $company_id != -1) {
            $oneCompanyAmount = ClientCompanyWalletQueryCollection::printOneCompanyAmount($company_id);
            $data['company_name'] = $oneCompanyAmount['company_name'];
            $data['one_company_amount'] = $oneCompanyAmount['one_company_amount'];
        }

        return $data;
    }
}
