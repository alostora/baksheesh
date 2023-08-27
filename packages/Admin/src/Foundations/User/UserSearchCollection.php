<?php

namespace Admin\Foundations\User;

use App\Constants\SystemDefault;

class UserSearchCollection
{
    public static function searchUsers(
        $user_account_type_id = -1,
        $query_string = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $users = UserQueryCollection::searchAllUsers(
            $user_account_type_id,
            $query_string
        );

        return $users->paginate($per_page);
    }
}
