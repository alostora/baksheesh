<?php

namespace Client\Foundations\ClientCompany\CompanyAvailableRating;

use App\Constants\SystemDefault;
use App\Models\CompanyAvailableRating;

class CompanyAvailableRatingSearchCollection
{
    public static function searchCompanyAvailableRatings(
        $query_string = -1,
        $archived = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {

        $data['availableRatings'] = CompanyAvailableRatingQueryCollection::searchAllCompanyAvailableRatings(
            $query_string,
            $archived,
        )->paginate($per_page);

        $data['count_active'] =  CompanyAvailableRating::where('client_id', auth()->id())
            ->where('stopped_at', null)->count();

        $data['count_inactive'] = CompanyAvailableRating::where('client_id', auth()->id())

            ->where('stopped_at',  '!=', null)->count();;

        return $data;
    }
}
