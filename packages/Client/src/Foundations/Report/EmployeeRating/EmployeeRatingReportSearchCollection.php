<?php

namespace Client\Foundations\Report\EmployeeRating;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\User;

class EmployeeRatingReportSearchCollection
{

    public static function searchAllEmployeeRating(
        $rating_value = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['employee_ratings'] = EmployeeRatingReportQueryCollection::searchEmployeeRating(
            $rating_value,
            $date_from,
            $date_to
        )->paginate($per_page);


        $data['employees'] = User::where('client_id', auth()->id())
            ->where('user_account_type_id', AccountTypeCollection::employee()->id)
            ->get();

        $data['companies'] = Company::where('client_id', auth()->id())->get();

        return $data;
    }
}
