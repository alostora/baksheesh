<?php

namespace Client\Foundations\ClientEmployee;

use App\Models\User;

class ClientEmployeeQueryCollection
{
    public static function searchAllEmployees(
        $query_string = -1
    ) {
        return User::where('client_id', auth()->id())

            ->where('company_id', null)

            ->where(function ($q) use ($query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
