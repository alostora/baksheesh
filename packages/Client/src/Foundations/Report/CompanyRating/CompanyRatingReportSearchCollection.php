<?php

namespace Client\Foundations\Report\CompanyRating;

use App\Constants\SystemDefault;
use App\Models\Company;
use App\Models\CompanyRating;

class CompanyRatingReportSearchCollection
{

    public static function searchAllCompanyRating(
        $company_id = -1,
        $rating_value = -1,
        $date_from = -1,
        $date_to = -1,
        $sort = SystemDefault::DEFAUL_SORT,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $data['company_ratings'] = CompanyRatingReportQueryCollection::searchCompanyRating(
            $company_id,
            $rating_value,
            $date_from,
            $date_to,
            $sort
        )->paginate($per_page);


        $data['companies'] = Company::where('client_id', auth()->id())
            ->where('stopped_at', null)
            ->get();

        $data['company_name'] = ($company_id && $company_id != -1) && Company::find($company_id) ? Company::find($company_id)->name : '';


        $data['total_bad_count'] = CompanyRating::where('client_id', auth()->id())

            ->where('rating_value', 1)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->count();


        $data['total_good_count'] = CompanyRating::where('client_id', auth()->id())

            ->where('rating_value', 2)

            ->where(function ($q) use ($company_id) {

                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->count();


        return $data;
    }
}
