<?php

namespace Client\Foundations\ClientEmployee\Employee;

use App\Constants\SystemDefault;

class EmployeeSearchCollection
{
    public static function searchEmployees(
        $company_id = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        $employees = EmployeeQueryCollection::searchAllEmployees(
            $company_id,
            $sort,
        );

        return $employees->get();
    }
}
