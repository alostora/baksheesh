<?php

namespace Admin\Foundations\User;

use App\Models\User;

class UserQueryCollection
{
    public static function searchAllUsers(
        $query_string = -1,
    ) {
        return User::where(function ($q) use ($query_string) {

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%');
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
