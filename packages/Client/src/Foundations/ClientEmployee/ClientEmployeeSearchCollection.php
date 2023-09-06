<?php

namespace Client\Foundations\ClientEmployee;

use App\Constants\SystemDefault;

class ClientEmployeeSearchCollection
{
    public static function searchEmployees(
        $query_string = -1,
        $active = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $employees = ClientEmployeeQueryCollection::searchAllEmployees(
            $query_string,
            $active,
        );

        return $employees->paginate($per_page);
    }
}
