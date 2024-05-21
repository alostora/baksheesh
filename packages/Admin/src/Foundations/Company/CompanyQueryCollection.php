<?php

namespace Admin\Foundations\Company;

use App\Constants\SystemDefault;
use App\Models\Company;
use App\Models\User;

class CompanyQueryCollection
{
    public static function searchAllCompanies(
        $client_id = -1,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return Company::where(function ($q) use ($client_id, $query_string, $active) {

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }

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

    public static function searchAllClientCompanies(
        User $user,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
    ) {
        return Company::where('client_id', $user->id)

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
