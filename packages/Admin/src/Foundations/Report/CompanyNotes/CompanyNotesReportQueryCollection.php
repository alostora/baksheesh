<?php

namespace Admin\Foundations\Report\CompanyNotes;

use App\Constants\SystemDefault;
use App\Models\CompanyCash;
use Carbon\Carbon;

class CompanyNotesReportQueryCollection
{
    public static function searchCompanyNotes(
        $client_id = -1,
        $company_id = -1,
        $query_string = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT
    ) {
        return CompanyCash::where(function ($q) use ($client_id, $company_id, $query_string, $date_from, $date_to) {

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }

            if ($company_id && $company_id != -1) {

                $q
                    ->where('company_id', $company_id);
            }

            if ($query_string && $query_string != -1) {

                $q
                    ->where('notes', 'like', '%' . $query_string . '%');
            } else {
                $q
                    ->where('notes', '!=', null);
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
            ->orderBy('created_at', $sort);
    }
}
