<?php

namespace Client\Foundations\Report\EmployeeRating;

use App\Constants\SystemDefault;

class EmployeeRatingReportSearchCollection
{

    public static function searchAllEmployeeRating(
        $rating_value = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $employeeRatingReports = EmployeeRatingReportQueryCollection::searchEmployeeRating(
            $rating_value,
            $date_from,
            $date_to
        );

        return $employeeRatingReports->paginate($per_page);
    }
}
