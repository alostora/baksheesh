<?php

namespace Admin\Foundations\Client;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class ClientQueryCollection
{
    public static function searchAllUsers(
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {

        $user_account_type = AccountTypeCollection::client();

        return User::where('user_account_type_id', $user_account_type->id)

            ->where(function ($q) use ($query_string, $active) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%')

                        ->orWhere('email', 'like', '%' . $query_string . '%');
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
