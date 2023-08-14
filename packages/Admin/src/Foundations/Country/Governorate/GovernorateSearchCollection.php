<?php

namespace Admin\Foundations\Country\Governorate;

use App\Constants\SystemDefault;
use App\Models\Country;

class GovernorateSearchCollection
{
    public static function searchCountryGovernorates(
        Country $country,
        $query_string = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = GovernorateQueryCollection::searchCountryGovernorates(
            $country,
            $query_string
        );

        return $countries->paginate($per_page);
    }
    
    public static function searchAllGovernorates(
        $country_id,
        $query_string = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = GovernorateQueryCollection::searchAllGovernorates(
            $country_id,
            $query_string
        );

        return $countries->paginate($per_page);
    }
}
