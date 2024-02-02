<?php

namespace Client\Foundations\ClientCompany\CompanyAvailableRating;

use App\Models\CompanyAvailableRating;

class CompanyAvailableRatingQueryCollection
{
    public static function searchAllCompanyAvailableRatings(
        $query_string = -1,
        $active = -1,
    ) {

        return CompanyAvailableRating::where('client_id', auth()->id())

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
            ->orderBy('created_at', 'DESC');
    }
}
