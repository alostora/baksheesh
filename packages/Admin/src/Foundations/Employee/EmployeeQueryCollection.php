<?php

namespace Admin\Foundations\Employee;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class EmployeeQueryCollection
{
    public static function searchAllEmployees(
        $client_id = -1,
        $company_id = -1,
        $sort = SystemDefault::DEFAUL_SORT
    ) {

        $lookup_account_type_employee = AccountTypeCollection::employee();

        return User::where('user_account_type_id', $lookup_account_type_employee->id)

            ->where('stopped_at', null)

            ->where(function ($q) use ($client_id, $company_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })

            ->orderBy('created_at', $sort);
    }
}
