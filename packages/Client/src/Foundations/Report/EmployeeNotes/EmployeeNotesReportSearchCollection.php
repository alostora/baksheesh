<?php

namespace Client\Foundations\Report\EmployeeNotes;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\User;

class EmployeeNotesReportSearchCollection
{

    public static function searchAllEmployeeNotes(
        $company_id = -1,
        $employee_id = -1,
        $query_string = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['employee_notes'] = EmployeeNotesReportQueryCollection::searchEmployeeNotes(
            $employee_id,
            $query_string,
            $date_from,
            $date_to
        )->paginate($per_page);


        $data['companies'] = Company::where('client_id', auth()->id())
            ->where('stopped_at', null)
            ->get();

        $data['employees'] = User::where('client_id', auth()->id())
            ->where('user_account_type_id', AccountTypeCollection::employee()->id)
            ->where('stopped_at', null)
            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })
            ->get();

        $data['company_name'] = $company_id && $company_id != -1 ? Company::find('company_id')->name : '';
        $data['employee_name'] = $employee_id && $employee_id != -1 ? User::find('employee_id')->name : '';

        return $data;
    }
}
