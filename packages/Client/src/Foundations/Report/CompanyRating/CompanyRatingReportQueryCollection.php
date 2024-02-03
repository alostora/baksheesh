<?php

namespace Client\Foundations\Report\CompanyRating;

use App\Models\CompanyRating;
use Carbon\Carbon;

class CompanyRatingReportQueryCollection
{
    public static function searchCompanyRating(
        $company_id = -1,
        $rating_value = -1,
        $date_from = -1,
        $date_to = -1
    ) {
        return CompanyRating::where('client_id', auth()->id())

            ->where(function ($q) use ($company_id, $rating_value, $date_from, $date_to) {


                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }

                if ($rating_value && $rating_value != -1) {

                    $q
                        ->where('rating_value', $rating_value);
                }

                if ($date_from && $date_from != -1 && $date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [

                            Carbon::create($date_from),

                            Carbon::create($date_to)->endOfDay()
                        ]);
                } else if ($date_from && $date_from != -1) {

                    $q
                        ->whereBetween('created_at', [

                            Carbon::create($date_from)->startOfDay(),

                            Carbon::create(3000, 01, 01)
                        ]);
                } else if ($date_to && $date_to != -1) {

                    $q
                        ->whereBetween('created_at', [

                            Carbon::create(1900, 01, 01),

                            Carbon::create($date_to)->endOfDay()
                        ]);
                }
            })
            ->orderBy('rating_value', 'DESC');
    }
}
