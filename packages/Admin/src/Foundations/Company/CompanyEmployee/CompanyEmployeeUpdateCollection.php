<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Constants\HasLookupType\UserAccountType;
use App\Models\Company;
use App\Models\SystemLookup;
use App\Models\User;

class CompanyEmployeeUpdateCollection
{
    public static function updateCompanyEmployee($request, $user)
    {

        $validated = $request->validated();

        $validated['client_id'] = Company::find($validated['company_id'])->client_id;

        $user->update($validated);

        return $user;
    }
}
