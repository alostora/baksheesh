<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Constants\HasLookupType\UserAccountType;
use App\Models\SystemLookup;
use App\Models\User;

class CompanyEmployeeQueryCollection
{
    public static function searchAllCompanEmployees(
        $query_string = -1,
    ) {


        $lookup_account_type_employee = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('key', UserAccountType::EMPLOYEE['key'])
            ->first();

        return User::where('user_account_type_id', $lookup_account_type_employee->id)

            ->where(function ($q) use ($query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
