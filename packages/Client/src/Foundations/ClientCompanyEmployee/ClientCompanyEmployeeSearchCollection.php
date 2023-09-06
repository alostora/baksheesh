<?php

namespace Client\Foundations\ClientCompanyEmployee;

use App\Constants\SystemDefault;

class ClientCompanyEmployeeSearchCollection
{
    public static function searchCompanyEmployees(
        $company_id = -1,
        $query_string = -1,
        $active = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = ClientCompanyEmployeeQueryCollection::searchAllCompanyEmployees(
            $company_id,
            $query_string,
            $active,
        );

        return $companies->paginate($per_page);
    }
}
