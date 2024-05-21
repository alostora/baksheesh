<?php

namespace Client\Foundations\ClientEmployee\Employee;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class EmployeeQueryCollection
{
    public static function searchAllEmployees(
        $company_id = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {

        return User::where('client_id', auth()->id())

            ->where('stopped_at', null)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })

            ->orderBy('created_at', $sort);
    }
}
