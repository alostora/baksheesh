<?php

namespace Admin\Foundations\Employee;

use App\Constants\SystemDefault;

class EmployeeSearchCollection
{
    public static function searchEmployees(
        $client_id = -1,
        $company_id = -1,
        $sort = SystemDefault::DEFAUL_SORT
    ) {
        $employees = EmployeeQueryCollection::searchAllEmployees(
            $client_id,
            $company_id,
            $sort,
        );

        return $employees->get();
    }
}
