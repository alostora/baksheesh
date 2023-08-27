<?php

namespace Client\Foundations\ClientEmployee;

use App\Constants\HasLookupType\UserAccountType;
use App\Models\SystemLookup;
use App\Models\User;

class ClientEmployeeCreateCollection
{
    public static function createClientEmployee($request)
    {

        $lookup_account_type_employee = SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
            ->where('key', UserAccountType::EMPLOYEE['key'])
            ->first();

        $validated = $request->validated();

        $validated['user_account_type_id'] = $lookup_account_type_employee->id;

        $validated['client_id'] = auth()->id();

        return User::create($validated);
    }
}
