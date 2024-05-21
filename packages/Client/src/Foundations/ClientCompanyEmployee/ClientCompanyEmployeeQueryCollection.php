<?php

namespace Client\Foundations\ClientCompanyEmployee;

use App\Constants\SystemDefault;
use App\Models\User;

class ClientCompanyEmployeeQueryCollection
{
    public static function searchAllCompanyEmployees(
        $company_id = -1,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {

        return User::where('client_id', auth()->id())

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
            ->orderBy('created_at', $sort);
    }
}
