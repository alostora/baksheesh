<?php

namespace Admin\Foundations\Company;

use App\Models\Company;
use App\Models\User;

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

    public static function searchAllClientCompanies(
        User $user,
        $query_string = -1
    ) {
        return Company::where('client_id', $user->id)

            ->where(function ($q) use ($query_string) {

                if ($query_string && $query_string != -1) {

                    $q
                        ->where('name', 'like', '%' . $query_string . '%');
                }
            })
            ->orderBy('created_at', 'DESC');
    }
}
