<?php

namespace Admin\Foundations\Report\CompanyNotes;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\User;

class CompanyNotesReportSearchCollection
{

    public static function searchAllCompanyNotes(
        $client_id = -1,
        $company_id = -1,
        $query_string = -1,
        $date_from = -1,
        $date_to = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['company_notes'] = CompanyNotesReportQueryCollection::searchCompanyNotes(
            $client_id,
            $company_id,
            $query_string,
            $date_from,
            $date_to
        )->paginate($per_page);


        $data['clients'] = User::where('user_account_type_id', AccountTypeCollection::client()->id)
            ->where('stopped_at', null)->get();

        $data['companies'] = Company::where(function ($q) use ($client_id) {

            $q
                ->where('client_id', $client_id);
        })
            ->where('stopped_at', null)
            ->get();

        $data['client_name'] = $client_id && $client_id != -1 ? User::find($client_id)->name : '';

        $data['company_name'] = $company_id && $company_id != -1 ? Company::find($company_id)->name : '';

        return $data;
    }
}
