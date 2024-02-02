<?php

namespace Admin\Foundations\Company\CompanyAvailableRating;

use App\Constants\SystemDefault;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\CompanyAvailableRating;
use App\Models\User;

class CompanyAvailableRatingSearchCollection
{
    public static function searchCompanyAvailableRatings(
        $client_id = -1,
        $query_string = -1,
        $archived = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {

        $data['availableRatings'] = CompanyAvailableRatingQueryCollection::searchAllCompanyAvailableRatings(
            $client_id,
            $query_string,
            $archived,
        )->paginate($per_page);

        $data['clients'] = User::where('user_account_type_id', AccountTypeCollection::client()->id)

            ->where('stopped_at', null)

            ->get();

        $data['count_active'] =  CompanyAvailableRating::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }
        })->where('stopped_at', null)->count();

        $data['count_inactive'] = CompanyAvailableRating::where(function ($q) use ($client_id) {


            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }
        })->where('stopped_at', '!=', null)->count();


        return $data;
    }
}
