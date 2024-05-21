<?php

namespace Admin\Foundations\Country\Governorate;

use App\Constants\HasLookupType\CountryType;
use App\Constants\SystemDefault;
use App\Models\Country;

class GovernorateQueryCollection
{
    public static function searchCountryGovernorates(
        Country $country,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return Country::where('country_id', $country->id)

            ->where('type', CountryType::GOVERNORATE['code'])

            ->whereHas('country')

            ->where(function ($q) use ($query_string, $active) {


                if ($query_string && $query_string != -1) {

                    $q

                        ->where(function ($q) use ($query_string) {

                            $q
                                ->where('name', 'like', '%' . $query_string . '%')

                                ->orWhere('name_ar', 'like', '%' . $query_string . '%');
                        });
                }

                if ($active == 'active') {

                    $q
                        ->where('stopped_at', null);
                } elseif ($active == 'inactive') {

                    $q
                        ->where('stopped_at', '!=', null);
                }
            })
            ->orderBy('created_at', $sort);
    }

    public static function searchAllGovernorates(
        $country_id,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return Country::where('type', CountryType::GOVERNORATE['code'])
            ->whereHas('country')
            ->where(function ($q) use ($country_id, $query_string, $active) {

                if ($country_id && $country_id != -1) {

                    return $q
                        ->where('country_id', $country_id);
                }
                if ($query_string && $query_string != -1) {

                    return $q
                        ->where('name', 'like', '%' . $query_string . '%')
                        ->orWhere('name_ar', 'like', '%' . $query_string . '%')
                        ->orWhere('prefix', 'like', '%' . $query_string . '%');
                }

                if ($active == 'active') {

                    $q
                        ->where('stopped_at', null);
                } elseif ($active == 'inactive') {

                    $q
                        ->where('stopped_at', '!=', null);
                }
            })
            ->orderBy('created_at', $sort);
    }
}
