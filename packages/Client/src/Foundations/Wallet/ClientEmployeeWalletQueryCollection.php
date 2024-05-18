<?php

namespace Client\Foundations\Wallet;

use App\Models\EmployeeCash;
use Carbon\Carbon;
use Client\Foundations\Collection;

class ClientEmployeeWalletQueryCollection
{
    public static function searchAllEmployeeWallets(
        $company_id = -1,
        $employee_id = -1,
        $date_from = -1,
        $date_to = -1,
    ) {
        return EmployeeCash::where('amount', '>', 0)

            ->where('client_id', auth()->id())

            ->where(function ($q) use ($company_id, $employee_id, $date_from, $date_to) {


                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($employee_id && $employee_id != -1) {

                    $q
                        ->where('employee_id', $employee_id);
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

    public static function sumEmployeeCashAmount($company_id = -1, $employee_id = -1)
    {

        $employee_amount = EmployeeCash::where('client_id', auth()->id())

            ->where('amount', '>', 0)

            ->where(function ($q) use ($company_id, $employee_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($employee_id && $employee_id != -1) {

                    $q
                        ->where('employee_id', $employee_id);
                }
            });

        return Collection::getNetAmount($employee_amount);
    }


    public static function printAllEmployeesAmount()
    {
        $employee_amount = EmployeeCash::where('client_id', auth()->id())

            ->where('amount', '>', 0);

        return Collection::getNetAmount($employee_amount);
    }
}
