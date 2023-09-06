<?php

namespace Admin\Foundations\Country;

use App\Constants\SystemDefault;

class CountrySearchCollection
{
    public static function searchCountries(
        $query_string = -1,
        $active = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $countries = CountryQueryCollection::searchAllCountries(
            $query_string,
            $active,
        );

        return $countries->paginate($per_page);
    }
}
