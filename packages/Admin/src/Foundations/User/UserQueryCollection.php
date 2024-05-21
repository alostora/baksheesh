<?php

namespace Admin\Foundations\User;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class UserQueryCollection
{
    public static function searchAllUsers(
        $user_account_type_id = -1,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return User::where(function ($q) use ($user_account_type_id, $query_string, $active) {

            if ($user_account_type_id && $user_account_type_id != -1) {

                $q
                    ->where('user_account_type_id', $user_account_type_id);
            } else {
                $q
                    ->where('user_account_type_id', AccountTypeCollection::admin()->id)
                    ->orWhere('user_account_type_id', AccountTypeCollection::root()->id);
            }

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
