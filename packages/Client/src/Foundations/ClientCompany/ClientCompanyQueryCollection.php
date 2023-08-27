<?php

namespace Client\Foundations\ClientCompany;

use App\Models\Company;

class ClientCompanyQueryCollection
{
    public static function searchAllCompanies(
        $query_string = -1
    ) {
        return Company::where('client_id', auth()->id())

            ->where(function ($q) use ($query_string) {


                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
