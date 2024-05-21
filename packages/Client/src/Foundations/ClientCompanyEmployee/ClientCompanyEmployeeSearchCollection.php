<?php

namespace Client\Foundations\ClientCompanyEmployee;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\User;

class ClientCompanyEmployeeSearchCollection
{
    public static function searchCompanyEmployees(
        $company_id = -1,
        $query_string = -1,
        $active = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['employees'] = ClientCompanyEmployeeQueryCollection::searchAllCompanyEmployees(
            $company_id,
            $query_string,
            $active,
            $sort
        )->paginate($per_page);

        $data['companies'] = Company::where('client_id', auth()->id())->get();

        $data['count_active'] =  User::where('client_id', auth()->id())->where('user_account_type_id', AccountTypeCollection::employee()->id)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->where('stopped_at', null)->count();

        $data['count_inactive'] = User::where('client_id', auth()->id())->where('user_account_type_id', AccountTypeCollection::employee()->id)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->where('stopped_at', '!=', null)->count();

        return $data;
    }
}
