<?php

namespace Client\Foundations\Wallet;

use App\Models\Company;
use App\Models\CompanyCash;
use Carbon\Carbon;
use Client\Foundations\Collection;

class ClientCompanyWalletQueryCollection
{
    public static function searchAllCompanyWallets(
        $company_id = -1,
        $date_from = -1,
        $date_to = -1,
    ) {
        return CompanyCash::where('amount', '>', 0)
            ->where('client_id', auth()->id())

            ->where(function ($q) use ($company_id, $date_from, $date_to) {

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

    public static function sumCompanyCashAmount($company_id = -1)
    {

        $company_amount = CompanyCash::where('client_id', auth()->id())

            ->where('amount', '>', 0)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            });

        return Collection::getNetAmount($company_amount);
    }

    public static function printAllCompaniesAmount()
    {
        $company_amount = CompanyCash::where('client_id', auth()->id())

            ->where('amount', '>', 0);

        return Collection::getNetAmount($company_amount);
    }

    public static function printOneCompanyAmount($company_id)
    {

        $data['company_name'] = Company::find($company_id)->name;

        $one_company_amount = CompanyCash::where('amount', '>', 0)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            });

        $data['one_company_amount'] = Collection::getNetAmount($one_company_amount);

        return $data;
    }
}
