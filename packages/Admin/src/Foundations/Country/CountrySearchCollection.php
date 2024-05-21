<?php

namespace Admin\Foundations\Country;

use App\Constants\HasLookupType\CountryType;
use App\Constants\SystemDefault;
use App\Models\Country;

class CountrySearchCollection
{
    public static function searchCountries(
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {

        $data['countries'] = CountryQueryCollection::searchAllCountries(
            $query_string,
            $active,
            $sort,
        )->paginate($per_page);

        $data['count_active'] = Country::where('type', CountryType::COUNTRY['code'])->where('stopped_at', null)->count();

        $data['count_inactive'] = Country::where('type', CountryType::COUNTRY['code'])->where('stopped_at', '!=', null)->count();

        return $data;
    }
}
