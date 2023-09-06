<?php

namespace Client\Foundations\ClientCompany;

use App\Constants\SystemDefault;

class ClientCompanySearchCollection
{
    public static function searchCompanies(
        $query_string = -1,
        $active = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = ClientCompanyQueryCollection::searchAllCompanies(
            $query_string,
            $active,
        );

        return $companies->paginate($per_page);
    }
}
