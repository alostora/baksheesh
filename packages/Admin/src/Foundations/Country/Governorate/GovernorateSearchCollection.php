<?php

namespace Admin\Foundations\Country\Governorate;

use App\Constants\HasLookupType\CountryType;
use App\Constants\SystemDefault;
use App\Models\Country;

class GovernorateSearchCollection
{
    public static function searchCountryGovernorates(
        Country $country,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['governorates'] = GovernorateQueryCollection::searchCountryGovernorates(
            $country,
            $query_string,
            $active,
            $sort,
        )->paginate($per_page);

        $data['count_active'] = Country::where('type', CountryType::GOVERNORATE['code'])->where('stopped_at', null)->count();

        $data['count_inactive'] = Country::where('type', CountryType::GOVERNORATE['code'])->where('stopped_at', '!=', null)->count();

        $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])->where('stopped_at', null)->get();

        return $data;
    }

    public static function searchAllGovernorates(
        $country_id,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['governorates'] = GovernorateQueryCollection::searchAllGovernorates(
            $country_id,
            $query_string,
            $active,
            $sort,
        )->paginate($per_page);

        $data['count_active'] = Country::where('type', CountryType::GOVERNORATE['code'])->where('stopped_at', null)->count();

        $data['count_inactive'] = Country::where('type', CountryType::GOVERNORATE['code'])->where('stopped_at', '!=', null)->count();

        $data['countries'] = Country::where('type', CountryType::COUNTRY['code'])->where('stopped_at', null)->get();

        return $data;
    }
}
