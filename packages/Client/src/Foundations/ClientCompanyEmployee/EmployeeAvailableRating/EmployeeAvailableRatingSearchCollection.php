<?php

namespace Client\Foundations\ClientCompanyEmployee\EmployeeAvailableRating;

use App\Constants\SystemDefault;
use App\Models\EmployeeAvailableRating;

class EmployeeAvailableRatingSearchCollection
{
    public static function searchEmployeeAvailableRatings(
        $query_string = -1,
        $archived = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {

        $data['availableRatings'] = EmployeeAvailableRatingQueryCollection::searchAllEmployeeAvailableRatings(
            $query_string,
            $archived,
            $sort
        )->paginate($per_page);

        $data['count_active'] =  EmployeeAvailableRating::where('client_id', auth()->id())
            ->where('stopped_at', null)->count();

        $data['count_inactive'] = EmployeeAvailableRating::where('client_id', auth()->id())
            ->where('stopped_at', '!=', null)->count();


        return $data;
    }
}
