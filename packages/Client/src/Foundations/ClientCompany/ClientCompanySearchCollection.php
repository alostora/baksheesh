<?php

namespace Client\Foundations\ClientCompany;

use App\Constants\SystemDefault;
use App\Models\Company;

class ClientCompanySearchCollection
{
    public static function searchCompanies(
        $query_string = -1,
        $active = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['companies'] = ClientCompanyQueryCollection::searchAllCompanies(
            $query_string,
            $active,
        )->paginate($per_page);

        $data['count_active'] = Company::where('client_id', auth()->id())->where('stopped_at', null)->count();

        $data['count_inactive'] = Company::where('client_id', auth()->id())->where('stopped_at', '!=', null)->count();

        return $data;
    }
}
