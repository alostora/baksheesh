<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Constants\SystemDefault;

class CompanyEmployeeSearchCollection
{
    public static function searchCompanyEmployees(
        $company_id = -1,
        $query_string = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = CompanyEmployeeQueryCollection::searchAllCompanyEmployees(
            $company_id,
            $query_string
        );

        return $companies->paginate($per_page);
    }
}
