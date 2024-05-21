<?php

namespace Admin\Foundations\Country\District;

use App\Constants\SystemDefault;
use App\Models\Country;

class DistrictSearchCollection
{
    public static function searchCountryDistricts(
        Country $country,
        $query_string = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = DistrictQueryCollection::searchCountryDistricts(
            $country,
            $query_string,
            $sort
        );

        return $countries->paginate($per_page);
    }

    public static function searchAllDistricts(
        $country_id,
        $query_string = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = DistrictQueryCollection::searchAllDistricts(
            $country_id,
            $query_string,
            $sort
        );

        return $countries->paginate($per_page);
    }
}
