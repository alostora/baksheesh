<?php

namespace Admin\Foundations\Report\EmployeeRating;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\EmployeeRating;
use App\Models\User;

class EmployeeRatingReportSearchCollection
{

    public static function searchAllEmployeeRating(
        $client_id = -1,
        $company_id = -1,
        $employee_id = -1,
        $rating_value = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['employee_ratings'] = EmployeeRatingReportQueryCollection::searchEmployeeRating(
            $client_id,
            $company_id,
            $employee_id,
            $rating_value,
            $date_from,
            $date_to,
            $sort
        )->paginate($per_page);

        $data['clients'] = User::where('user_account_type_id', AccountTypeCollection::client()->id)
            ->where('stopped_at', null)->get();

        $data['companies'] = Company::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }
        })
            ->where('stopped_at', null)
            ->get();


        $data['employees'] = User::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }
        })
            ->where('user_account_type_id', AccountTypeCollection::employee()->id)
            ->where('stopped_at', null)
            ->get();

        $data['total_bad_count'] = EmployeeRating::where('rating_value', 1)

            ->where(function ($q) use ($client_id, $company_id, $employee_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($employee_id && $employee_id != -1) {

                    $q
                        ->where('employee_id', $employee_id);
                }
            })->count();


        $data['total_good_count'] = EmployeeRating::where('rating_value', 2)

            ->where(function ($q) use ($client_id, $company_id, $employee_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
                if ($employee_id && $employee_id != -1) {

                    $q
                        ->where('employee_id', $employee_id);
                }
            })->count();

        $data['client_name'] = ($client_id && $client_id != -1) && User::find($client_id) ? User::find($client_id)->name : '';

        $data['company_name'] = ($company_id && $company_id != -1) && Company::find($company_id) ? Company::find($company_id)->name : '';

        $data['employee_name'] = ($employee_id && $employee_id != -1) && User::find($employee_id) ? User::find($employee_id)->name : '';

        return $data;
    }
}
