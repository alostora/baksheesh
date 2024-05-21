<?php

namespace Admin\Foundations\Country\Zone;

use App\Constants\SystemDefault;
use App\Models\Country;

class ZoneSearchCollection
{
    public static function searchCountryZones(
        Country $country,
        $query_string = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = ZoneQueryCollection::searchCountryZones(
            $country,
            $query_string,
            $sort
        );

        return $countries->paginate($per_page);
    }

    public static function searchAllZones(
        $country_id,
        $query_string = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = ZoneQueryCollection::searchAllZones(
            $country_id,
            $query_string,
            $sort
        );

        return $countries->paginate($per_page);
    }
}
