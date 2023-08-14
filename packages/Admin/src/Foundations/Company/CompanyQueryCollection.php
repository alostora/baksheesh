<?php

namespace Admin\Foundations\Company;

use App\Models\Company;

class CompanyQueryCollection
{
    public static function searchAllCompanies(
        $client_id = -1,
        $query_string = -1
    ) {
        return Company::where(function ($q) use ($query_string, $client_id) {

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }

            if ($query_string && $query_string != -1) {

                $q
                    ->where('name', 'like', '%' . $query_string . '%');
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
