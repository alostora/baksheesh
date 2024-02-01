<?php

namespace Admin\Foundations\Employee\EmployeeAvailableRating;

use App\Models\EmployeeAvailableRating;

class EmployeeAvailableRatingQueryCollection
{
    public static function searchAllEmployeeAvailableRatings(
        $company_id,
        $employee_id,
        $query_string = -1,
        $active = -1,
    ) {

        return EmployeeAvailableRating::where(function ($q) use ($company_id, $employee_id, $query_string, $active) {

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%');
            }


            if ($company_id && $company_id != -1) {

                $q
                    ->where('company_id', $company_id);
            }

            if ($employee_id && $employee_id != -1) {

                $q
                    ->where('employee_id', $employee_id);
            }

            if ($active == 'active') {

                $q
                    ->where('stopped_at', null);
            } elseif ($active == 'inactive') {

                $q
                    ->where('stopped_at', '!=', null);
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
