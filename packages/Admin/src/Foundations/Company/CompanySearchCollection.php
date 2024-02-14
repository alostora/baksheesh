<?php

namespace Admin\Foundations\Company;

use Admin\Foundations\Filter\FilterCollection;
use App\Constants\SystemDefault;
use App\Models\Company;
use App\Models\User;

class CompanySearchCollection
{
    public static function searchCompanies(
        $client_id = -1,
        $query_string = -1,
        $active = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['companies'] = CompanyQueryCollection::searchAllCompanies(
            $client_id,
            $query_string,
            $active,
        )->paginate($per_page);

        $data['count_active'] = Company::where('stopped_at', null)->count();

        $data['count_inactive'] = Company::where('stopped_at', '!=', null)->count();

        $data['clients'] = FilterCollection::clients();

        return $data;
    }

    public static function searchClientCompanies(
        User $user,
        $query_string = -1,
        $active = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['companies'] = CompanyQueryCollection::searchAllClientCompanies(
            $user,
            $query_string,
            $active
        )->paginate($per_page);

        $data['count_active'] = Company::where('stopped_at', null)->count();

        $data['count_inactive'] = Company::where('stopped_at', '!=', null)->count();

        $data['clients'] = FilterCollection::clients();

        return $data;
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
