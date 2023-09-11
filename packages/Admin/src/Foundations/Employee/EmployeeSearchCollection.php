<?php

namespace Admin\Foundations\Employee;

class EmployeeSearchCollection
{
    public static function searchEmployees(
        $client_id = -1,
        $company_id = -1
    ) {
        $employees = EmployeeQueryCollection::searchAllEmployees(
            $client_id,
            $company_id,
        );

        return $employees->get();
    }
}
