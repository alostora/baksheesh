<?php

namespace Admin\Foundations\Country;

use App\Constants\HasLookupType\CountryType;
use App\Models\Country;

class CountryQueryCollection
{
    public static function searchAllCountries(
        $query_string = -1,
        $active = -1,
    ) {
        return Country::where('type', CountryType::COUNTRY['code'])

            ->where(function ($q) use ($query_string, $active) {

                if ($query_string && $query_string != -1) {

                    $q

                        ->where(function ($q) use ($query_string) {

                            $q
                                ->orWhere('name_ar', 'like', '%' . $query_string . '%')

                                ->where('name', 'like', '%' . $query_string . '%');
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
            ->orderBy('created_at', 'DESC');
    }
}
