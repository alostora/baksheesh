<?php

namespace Client\Foundations\Report\EmployeeNotes;

use App\Constants\SystemDefault;

class EmployeeNotesReportSearchCollection
{

    public static function searchAllEmployeeNotes(
        $query_string = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $employeeNotesReports = EmployeeNotesReportQueryCollection::searchEmployeeNotes(
            $query_string,
            $date_from,
            $date_to
        );

        return $employeeNotesReports->paginate($per_page);
    }
}
