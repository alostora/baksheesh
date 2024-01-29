<?php

namespace Client\Foundations\Report\EmployeeNotes;

use App\Models\EmployeeCash;
use Carbon\Carbon;

class EmployeeNotesReportQueryCollection
{
    public static function searchEmployeeNotes(
        $query_string = -1,
        $date_from = -1,
        $date_to = -1
    ) {
        return EmployeeCash::where('client_id', auth()->id())

            ->where(function ($q) use ($query_string, $date_from, $date_to) {

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
            ->orderBy('created_at', 'DESC');
    }
}
