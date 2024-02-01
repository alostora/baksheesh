<?php

namespace Admin\Foundations\Company\CompanyAvailableRating;

use App\Models\CompanyAvailableRating;

class CompanyAvailableRatingQueryCollection
{
    public static function searchAllCompanyAvailableRatings(
        $company_id,
        $query_string = -1,
        $active = -1,
    ) {

        return CompanyAvailableRating::where(function ($q) use ($query_string, $company_id, $active) {

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%');
            }


            if ($company_id && $company_id != -1) {

                $q
                    ->where('company_id', $company_id);
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
