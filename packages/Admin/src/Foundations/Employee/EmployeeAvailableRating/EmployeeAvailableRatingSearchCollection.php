<?php

namespace Admin\Foundations\Employee\EmployeeAvailableRating;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\EmployeeAvailableRating;
use App\Models\User;

class EmployeeAvailableRatingSearchCollection
{
    public static function searchEmployeeAvailableRatings(
        $client_id = -1,
        $query_string = -1,
        $archived = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {

        $data['availableRatings'] = EmployeeAvailableRatingQueryCollection::searchAllEmployeeAvailableRatings(
            $client_id,
            $query_string,
            $archived,
            $sort
        )->paginate($per_page);


        $data['clients'] = User::where('user_account_type_id', AccountTypeCollection::client()->id)

            ->where('stopped_at', null)

            ->get();

        $data['count_active'] =  EmployeeAvailableRating::where(function ($q) use ($client_id) {


            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }
        })->where('stopped_at', null)->count();

        $data['count_inactive'] = EmployeeAvailableRating::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }
        })->where('stopped_at', '!=', null)->count();


        return $data;
    }
}
