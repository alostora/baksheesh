<?php

namespace Admin\Foundations\Employee\EmployeeAvailableRating;

use App\Constants\SystemDefault;
use App\Models\EmployeeAvailableRating;

class EmployeeAvailableRatingQueryCollection
{
    public static function searchAllEmployeeAvailableRatings(
        $client_id,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {

        return EmployeeAvailableRating::where(function ($q) use ($client_id, $query_string, $active) {

            if ($query_string && $query_string != -1) {

                $q
                    ->where(function ($q) use ($query_string) {
                        $q
                            ->where('name', 'like', '%' . $query_string . '%')
                            ->orWhere('name_ar', 'like', '%' . $query_string . '%');
                    });
            }

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
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
