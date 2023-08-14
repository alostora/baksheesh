<?php

namespace Admin\Foundations\Country\Zone;

use App\Constants\SystemDefault;
use App\Models\Country;

class ZoneSearchCollection
{
    public static function searchCountryZones(
        Country $country,
        $query_string = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = ZoneQueryCollection::searchCountryZones(
            $country,
            $query_string
        );

        return $countries->paginate($per_page);
    }

    public static function searchAllZones(
        $country_id,
        $query_string = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = ZoneQueryCollection::searchAllZones(
            $country_id,
            $query_string
        );

        return $countries->paginate($per_page);
    }
}
