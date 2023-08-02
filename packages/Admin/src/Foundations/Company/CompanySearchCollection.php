<?php

namespace Admin\Foundations\Company;

use App\Constants\SystemDefault;

class CompanySearchCollection
{
    public static function searchCompanies($query_string = -1, $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT)
    {
        $companies = CompanyQueryCollection::searchAllCompanies($query_string);

        return $companies->paginate($per_page);
    }
}
