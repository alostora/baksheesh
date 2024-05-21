<?php

namespace Client\Foundations\Report\CompanyNotes;

use App\Constants\SystemDefault;
use App\Models\Company;

class CompanyNotesReportSearchCollection
{

    public static function searchAllCompanyNotes(
        $company_id = -1,
        $query_string = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['company_notes'] = CompanyNotesReportQueryCollection::searchCompanyNotes(
            $company_id,
            $query_string,
            $date_from,
            $date_to,
            $sort
        )->paginate($per_page);


        $data['companies'] = Company::where('client_id', auth()->id())
            ->where('stopped_at', null)
            ->get();

        $data['company_name'] = $company_id && $company_id != -1 ? Company::find($company_id)->name : '';

        return $data;
    }
}
