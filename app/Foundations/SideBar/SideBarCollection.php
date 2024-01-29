<?php

namespace App\Foundations\SideBar;

use App\Constants\HasLookupType\UserAccountType;
use App\Models\Company;
use App\Models\SystemLookup;
use App\Models\User;

class SideBarCollection
{
    public static function sideBarInfo()
    {
        $adminIds =  SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code', '!=', UserAccountType::EMPLOYEE['code'])
            ->where('code', '!=', UserAccountType::CLIENT['code'])
            ->pluck('id');

        $clientId =  SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code', UserAccountType::CLIENT['code'])
            ->first()->id;

        $data['users_count'] = User::whereIn('user_account_type_id', $adminIds)
            ->where('stopped_at', null)
            ->count();

        $data['clients_count'] = User::where('user_account_type_id', $clientId)
            ->where('stopped_at', null)
            ->count();

        $data['companies_count'] = Company::where('stopped_at', null)
            ->count();

        return $data;
    }
}
