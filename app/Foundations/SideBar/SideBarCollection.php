<?php

namespace App\Foundations\SideBar;

use App\Constants\HasLookupType\UserAccountType;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\SystemLookup;
use App\Models\User;

class SideBarCollection
{
    public static function adminSideBarInfo()
    {
        $adminIds =  SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code', '!=', UserAccountType::EMPLOYEE['code'])
            ->where('code', '!=', UserAccountType::CLIENT['code'])
            ->pluck('id');

        $clientId =  AccountTypeCollection::client()->id;
        

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

    public static function clientSideBarInfo()
    {
        $employeeId =  SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('code', UserAccountType::EMPLOYEE['code'])
            ->first()->id;

        $data['employees_count'] = User::where('client_id', auth()->id())
            ->where('user_account_type_id', $employeeId)
            ->where('stopped_at', null)
            ->count();

        $data['companies_count'] = Company::where('client_id', auth()->id())
            ->where('stopped_at', null)
            ->count();

        return $data;
    }
}
