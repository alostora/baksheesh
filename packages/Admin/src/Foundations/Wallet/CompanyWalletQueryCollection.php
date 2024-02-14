<?php

namespace Admin\Foundations\Wallet;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\CompanyCash;
use App\Models\User;
use Carbon\Carbon;

class CompanyWalletQueryCollection
{
    public static function searchAllCompanyWallets(
        $client_id = -1,
        $company_id = -1,
        $date_from = -1,
        $date_to = -1,
    ) {
        return CompanyCash::where('amount', '>', 0)
            ->where(function ($q) use ($client_id, $company_id, $date_from, $date_to) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($date_from && $date_from != -1 && $date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [

                            Carbon::create($date_from),

                            Carbon::create($date_to)->endOfDay()
                        ]);
                } else if ($date_from && $date_from != -1) {

                    $q
                        ->whereBetween('created_at', [

                            Carbon::create($date_from)->startOfDay(),

                            Carbon::create(3000, 01, 01)
                        ]);
                } else if ($date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [

                            Carbon::create(1900, 01, 01),

                            Carbon::create($date_to)->endOfDay()
                        ]);
                }
            })
            ->orderBy('created_at', 'DESC');
    }

    public static function sumCompanyCashAmount($client_id = -1, $company_id = -1)
    {

        return CompanyCash::where('amount', '>', 0)

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
    }

    public static function printAllCompaniesAmount()
    {

        return CompanyCash::where('amount', '>', 0)->sum('amount');
    }

    public static function printClientCompaniesAmount($client_id)
    {

        $data['client_name'] = User::find($client_id)->name;

        $data['all_client_companies_amount'] = CompanyCash::where('amount', '>', 0)

            ->where(function ($q) use ($client_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }
            })->sum('amount');

        return $data;
    }

    public static function printOneCompanyAmount($company_id)
    {

        $data['company_name'] = Company::find($company_id)->name;

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
