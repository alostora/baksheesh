<?php

namespace Client\Foundations\ClientEmployee;

use App\Constants\HasLookupType\UserAccountType;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\SystemLookup;
use App\Models\User;

class ClientEmployeeCreateCollection
{
    public static function createClientEmployee($request)
    {

        $lookup_account_type_employee = AccountTypeCollection::employee();

        $validated = $request->validated();

        $validated['user_account_type_id'] = $lookup_account_type_employee->id;

        $validated['client_id'] = auth()->id();

        return User::create($validated);
    }
}
