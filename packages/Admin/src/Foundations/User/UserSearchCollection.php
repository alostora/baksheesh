<?php

namespace Admin\Foundations\User;

use App\Constants\SystemDefault;

class UserSearchCollection
{
    public static function searchUsers($query_string = -1, $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT)
    {
        $users = UserQueryCollection::searchAllUsers($query_string);

        return $users->paginate($per_page);
    }
}
