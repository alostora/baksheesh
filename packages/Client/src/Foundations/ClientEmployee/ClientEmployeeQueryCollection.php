<?php

namespace Client\Foundations\ClientEmployee;

use App\Constants\SystemDefault;
use App\Models\User;

class ClientEmployeeQueryCollection
{
    public static function searchAllEmployees(
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return User::where('client_id', auth()->id())

            ->where('company_id', null)

            ->where(function ($q) use ($query_string, $active) {

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
