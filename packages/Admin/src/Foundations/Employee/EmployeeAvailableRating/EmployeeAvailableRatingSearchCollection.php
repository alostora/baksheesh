<?php

namespace Admin\Foundations\Employee\EmployeeAvailableRating;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\EmployeeAvailableRating;
use App\Models\User;

class EmployeeAvailableRatingSearchCollection
{
    public static function searchEmployeeAvailableRatings(
        $company_id = -1,
        $employee_id = -1,
        $query_string = -1,
        $archived = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {

        $data['availableRatings'] = EmployeeAvailableRatingQueryCollection::searchAllEmployeeAvailableRatings(
            $company_id,
            $employee_id,
            $query_string,
            $archived,
        )->paginate($per_page);

        $data['companies'] = Company::where('stopped_at', null)->get();

        $data['employees'] = User::where('user_account_type_id', AccountTypeCollection::employee()->id)
            ->where('stopped_at', null)
            ->get();

        $data['count_active'] =  EmployeeAvailableRating::where(function ($q) use ($company_id, $employee_id) {


            if ($company_id && $company_id != -1) {

                $q
                    ->where('company_id', $company_id);
            }

            if ($employee_id && $employee_id != -1) {

                $q
                    ->where('employee_id', $employee_id);
            }
        })->where('stopped_at', null)->count();

        $data['count_inactive'] = EmployeeAvailableRating::where(function ($q) use ($company_id, $employee_id) {


            if ($company_id && $company_id != -1) {

                $q
                    ->where('company_id', $company_id);
            }

            if ($employee_id && $employee_id != -1) {

                $q
                    ->where('employee_id', $employee_id);
            }
        })->where('stopped_at', '!=', null)->count();


        return $data;
    }
}
