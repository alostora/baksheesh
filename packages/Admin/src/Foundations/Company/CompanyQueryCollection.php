<?php

namespace Admin\Foundations\Company;

use App\Models\Company;

class CompanyQueryCollection
{
    public static function searchAllCompanies(
        $query_string = -1,
    ) {
        return Company::where(function ($q) use ($query_string) {

            if ($query_string && $query_string != -1) {

                return $q
                    ->where('name', 'like', '%' . $query_string . '%');
            }
        })
            ->orderBy('created_at', 'DESC');
    }
}
