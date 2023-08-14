<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Constants\SystemDefault;

class CompanyEmployeeSearchCollection
{
    public static function searchCompanyEmployees($query_string = -1, $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT)
    {
        $companies = CompanyEmployeeQueryCollection::searchAllCompanEmployees($query_string);

        return $companies->paginate($per_page);
    }
}
