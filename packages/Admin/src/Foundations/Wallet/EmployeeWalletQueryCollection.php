<?php

namespace Admin\Foundations\Wallet;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\EmployeeCash;
use App\Models\User;
use Carbon\Carbon;

class EmployeeWalletQueryCollection
{
    public static function searchAllEmployeeWallets(
        $client_id = -1,
        $company_id = -1,
        $employee_id = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return EmployeeCash::where('amount', '>', 0)

            ->where(function ($q) use ($client_id, $company_id, $employee_id, $date_from, $date_to) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }

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
            ->orderBy('created_at', $sort);
    }

    public static function sumEmployeeCashAmount($client_id = -1, $company_id = -1, $employee_id = -1)
    {

        return EmployeeCash::where('amount', '>', 0)

            ->where(function ($q) use ($client_id, $company_id, $employee_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($employee_id && $employee_id != -1) {

                    $q
                        ->where('employee_id', $employee_id);
                }
            })->sum('amount');
    }

    public static function printAllEmployeesAmount()
    {

        return EmployeeCash::where('amount', '>', 0)->sum('amount');
    }

    public static function printClientEmployeesAmount($client_id)
    {

        $data['client_name'] = User::find($client_id)->name;

        $data['client_employees_amount'] = EmployeeCash::where('amount', '>', 0)

            ->where(function ($q) use ($client_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }
            })->sum('amount');

        return $data;
    }

    public static function printOneCompanyEmployeesAmount($company_id)
    {

        $data['company_name'] = Company::find($company_id)->name;

        $data['one_company_employees_amount'] = EmployeeCash::where('amount', '>', 0)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->sum('amount');

        return $data;
    }

    public static function printOneEmployeeAmount($employee_id)
    {

        $data['employee_name'] = User::find($employee_id)->name;

        $data['one_employee_amount'] = EmployeeCash::where('amount', '>', 0)

            ->where(function ($q) use ($employee_id) {

                if ($employee_id && $employee_id != -1) {

                    $q
                        ->where('employee_id', $employee_id);
                }
            })->sum('amount');

        return $data;
    }
}
