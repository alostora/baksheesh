<?php

namespace Admin\Foundations\Company\CompanyAvailableRating;

use App\Constants\SystemDefault;
use App\Models\Company;
use App\Models\CompanyAvailableRating;

class CompanyAvailableRatingSearchCollection
{
    public static function searchCompanyAvailableRatings(
        $company_id = -1,
        $query_string = -1,
        $archived = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {

        $data['availableRatings'] = CompanyAvailableRatingQueryCollection::searchAllCompanyAvailableRatings(
            $company_id,
            $query_string,
            $archived,
        )->paginate($per_page);

        $data['companies'] = Company::where('stopped_at', null)->get();

        $data['count_active'] =  CompanyAvailableRating::where(function ($q) use ($company_id) {

            if ($company_id && $company_id != -1) {

                $q
                    ->where('company_id', $company_id);
            }
        })->where('stopped_at', null)->count();

        $data['count_inactive'] = CompanyAvailableRating::where(function ($q) use ($company_id) {


            if ($company_id && $company_id != -1) {

                $q
                    ->where('company_id', $company_id);
            }
        })->where('stopped_at', '!=', null)->count();


        return $data;
    }
}
