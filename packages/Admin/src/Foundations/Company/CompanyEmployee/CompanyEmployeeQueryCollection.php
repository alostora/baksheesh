<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Constants\HasLookupType\UserAccountType;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\SystemLookup;
use App\Models\User;

class CompanyEmployeeQueryCollection
{
    public static function searchAllCompanyEmployees(
        $company_id = -1,
        $query_string = -1,
        $active = -1,
    ) {

        $lookup_account_type_employee = AccountTypeCollection::employee();

        return User::where('user_account_type_id', $lookup_account_type_employee->id)

            ->where(function ($q) use ($company_id, $query_string, $active) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }

                if ($active == 'active') {

                    $q
                        ->where('stopped_at', null);
                } elseif ($active == 'inactive') {

                    $q
                        ->where('stopped_at', '!=', null);
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
