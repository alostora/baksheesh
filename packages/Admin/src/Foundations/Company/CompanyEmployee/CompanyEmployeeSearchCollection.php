<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\User;

class CompanyEmployeeSearchCollection
{
    public static function searchCompanyEmployees(
        $client_id = -1,
        $company_id = -1,
        $query_string = -1,
        $archived = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['employees'] = CompanyEmployeeQueryCollection::searchAllCompanyEmployees(
            $client_id,
            $company_id,
            $query_string,
            $archived,
        )->paginate($per_page);

        $data['clients'] = User::where('user_account_type_id', AccountTypeCollection::client()->id)->get();

        $data['companies'] = Company::get();

        $data['count_active'] =  User::where('user_account_type_id', AccountTypeCollection::employee()->id)

            ->where(function ($q) use ($client_id, $company_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->where('stopped_at', null)->count();

        $data['count_inactive'] = User::where('user_account_type_id', AccountTypeCollection::employee()->id)

            ->where(function ($q) use ($client_id, $company_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->where('stopped_at', '!=', null)->count();


        return $data;
    }
}
