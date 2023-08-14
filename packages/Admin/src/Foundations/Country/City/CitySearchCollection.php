<?php

namespace Admin\Foundations\Country\City;

use App\Constants\SystemDefault;
use App\Models\Country;

class CitySearchCollection
{
    public static function searchCountryCities(
        Country $country,
        $query_string = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = CityQueryCollection::searchCountryCities(
            $country,
            $query_string
        );

        return $countries->paginate($per_page);
    }

    public static function searchAllCities(
        $country_id,
        $query_string = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = CityQueryCollection::searchAllCities(
            $country_id,
            $query_string
        );

        return $countries->paginate($per_page);
    }
}
