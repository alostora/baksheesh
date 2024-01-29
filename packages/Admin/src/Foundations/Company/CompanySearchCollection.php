<?php

namespace Admin\Foundations\Company;

use App\Constants\SystemDefault;
use App\Models\User;

class CompanySearchCollection
{
    public static function searchCompanies(
        $client_id = -1,
        $query_string = -1,
        $active = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = CompanyQueryCollection::searchAllCompanies(
            $client_id,
            $query_string,
            $active,
        );

        return $companies->paginate($per_page);
    }

    public static function searchClientCompanies(
        User $user,
        $query_string = -1,
        $active = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $companies = CompanyQueryCollection::searchAllClientCompanies(
            $user,
            $query_string,
            $active
        );

        return $companies->paginate($per_page);
    }

    public static function searchAllCompanies(
        $client_id = -1
    ) {
        $companies = CompanyQueryCollection::searchAllCompanies(
            $client_id,
        );

        return $companies->get();
    }
}
