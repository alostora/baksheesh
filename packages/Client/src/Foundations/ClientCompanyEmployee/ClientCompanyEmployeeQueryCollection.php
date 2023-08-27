<?php

namespace Client\Foundations\ClientCompanyEmployee;

use App\Models\User;

class ClientCompanyEmployeeQueryCollection
{
    public static function searchAllCompanyEmployees(
        $company_id = -1,
        $query_string = -1,
    ) {

        return User::where('client_id', auth()->id())

            ->where(function ($q) use ($company_id, $query_string) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
