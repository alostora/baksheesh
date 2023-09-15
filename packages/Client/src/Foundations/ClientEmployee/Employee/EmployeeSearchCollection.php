<?php

namespace Client\Foundations\ClientEmployee\Employee;

class EmployeeSearchCollection
{
    public static function searchEmployees(
        $company_id = -1
    ) {
        $employees = EmployeeQueryCollection::searchAllEmployees(
            $company_id,
        );

        return $employees->get();
    }
}
