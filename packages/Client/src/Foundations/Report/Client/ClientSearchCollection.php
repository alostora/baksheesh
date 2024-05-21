<?php

namespace Report\Foundations\Report\Client;

use App\Constants\SystemDefault;

class ClientSearchCollection
{
    public static function searchUsers(
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $users = ClientQueryCollection::searchAllUsers(
            $query_string,
            $active,
            $sort
        );

        return $users->paginate($per_page);
    }
}
