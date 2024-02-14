<?php

namespace Admin\Foundations\Filter;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\User;

class FilterCollection
{

    public static function clients()
    {
        return User::where('user_account_type_id', AccountTypeCollection::client()->id)->get();
    }

    public static function companies($client_id = -1)
    {
        return Company::where(function ($q) use ($client_id) {

            if ($client_id && $client_id != -1) {

                $q
                    ->where('client_id', $client_id);
            }
        })->get();
    }

    public static function employees($client_id = -1, $company_id = -1)
    {
        return User::where('user_account_type_id', AccountTypeCollection::employee()->id)

            ->where(function ($q) use ($client_id, $company_id) {

                if ($client_id && $client_id != -1) {

                    $q
                        ->where('client_id', $client_id);
                }
                if ($company_id && $company_id != -1) {

                    $q
                        ->where('company_id', $company_id);
                }
            })->get();
    }
}
