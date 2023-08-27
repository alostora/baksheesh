<?php

namespace Admin\Foundations\User;

use App\Models\User;

class UserQueryCollection
{
    public static function searchAllUsers(
        $user_account_type_id = -1,
        $query_string = -1
    ) {
        return User::where(function ($q) use ($query_string, $user_account_type_id) {

            if ($user_account_type_id && $user_account_type_id != -1) {

                $q
                    ->where('user_account_type_id', $user_account_type_id);
            }

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%');
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
