<?php

namespace Admin\Foundations\Wallet;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\CompanyCash;
use App\Models\User;

class CompanyWalletSearchCollection
{
    public static function searchCompanyWallets(
        $client_id = -1,
        $company_id = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['wallets'] = CompanyWalletQueryCollection::searchAllCompanyWallets(
            $client_id,
            $company_id,
            $date_from,
            $date_to,
        )->paginate($per_page);

        $client_type = AccountTypeCollection::client();

        $data['clients'] = User::where('user_account_type_id', $client_type->id)->get();

        $data['companies'] = Company::get();

        $data['count_total'] = CompanyCash::where('amount', '>', 0)

            ->where(function ($q) use ($client_id, $company_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->sum('amount');


        $data['all_companies_amount'] = CompanyCash::where('amount', '>', 0)->sum('amount');

        $data['all_clients_amount'] = CompanyCash::where('amount', '>', 0)

            ->where(function ($q) use ($client_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }
            })->sum('amount');

        $data['one_company_amount'] = CompanyCash::where('amount', '>', 0)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->sum('amount');

        return $data;
    }
}
