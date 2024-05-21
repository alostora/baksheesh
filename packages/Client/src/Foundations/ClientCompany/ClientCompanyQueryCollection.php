<?php

namespace Client\Foundations\ClientCompany;

use App\Constants\SystemDefault;
use App\Models\Company;

class ClientCompanyQueryCollection
{
    public static function searchAllCompanies(
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT
    ) {
        return Company::where('client_id', auth()->id())

            ->where(function ($q) use ($query_string, $active) {


                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
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
