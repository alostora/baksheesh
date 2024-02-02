<?php

namespace Client\Foundations\Report\EmployeeRating;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\EmployeeRating;
use App\Models\User;

class EmployeeRatingReportSearchCollection
{

    public static function searchAllEmployeeRating(
        $company_id = -1,
        $employee_id = -1,
        $rating_value = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['employee_ratings'] = EmployeeRatingReportQueryCollection::searchEmployeeRating(
            $company_id,
            $employee_id,
            $rating_value,
            $date_from,
            $date_to
        )->paginate($per_page);


        $data['employees'] = User::where('client_id', auth()->id())
            ->where('user_account_type_id', AccountTypeCollection::employee()->id)
            ->where('stopped_at', null)
            ->get();

        $data['companies'] = Company::where('client_id', auth()->id())
            ->where('stopped_at', null)
            ->get();


        $data['total_bad_count'] = EmployeeRating::where('client_id', auth()->id())

            ->where('rating_value', 1)

            ->where(function ($q) use ($company_id, $employee_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($employee_id && $employee_id != -1) {

                    $q
                        ->where('employee_id', $employee_id);
                }
            })->count();


        $data['total_good_count'] = EmployeeRating::where('client_id', auth()->id())

            ->where('rating_value', 2)

            ->where(function ($q) use ($company_id, $employee_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
                if ($employee_id && $employee_id != -1) {

                    $q
                        ->where('employee_id', $employee_id);
                }
            })->count();


        return $data;
    }
}
