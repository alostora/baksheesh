<?php

namespace Admin\Foundations\Wallet;

use Admin\Foundations\Filter\FilterCollection;
use App\Constants\SystemDefault;

class CompanyWalletSearchCollection
{
    public static function searchCompanyWallets(
        $client_id = -1,
        $company_id = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['wallets'] = CompanyWalletQueryCollection::searchAllCompanyWallets(
            $client_id,
            $company_id,
            $date_from,
            $date_to,
            $sort,
        )->paginate($per_page);

        //above table label info
        $data['count_total'] = CompanyWalletQueryCollection::sumCompanyCashAmount($client_id, $company_id);

        //print
        $data['all_companies_amount'] = CompanyWalletQueryCollection::printAllCompaniesAmount();

        if ($client_id && $client_id != -1) {
            $clientCompaniesAmount = CompanyWalletQueryCollection::printClientCompaniesAmount($client_id);
            $data['client_name'] = $clientCompaniesAmount['client_name'];
            $data['all_client_companies_amount'] =  $clientCompaniesAmount['all_client_companies_amount'];
        }

        if ($company_id && $company_id != -1) {
            $oneCompanyAmount = CompanyWalletQueryCollection::printOneCompanyAmount($company_id);
            $data['company_name'] = $oneCompanyAmount['company_name'];
            $data['one_company_amount'] = $oneCompanyAmount['one_company_amount'];
        }

        //filters
        $data['clients'] = FilterCollection::clients();

        $data['companies'] = FilterCollection::companies($client_id);

        return $data;
    }
}
