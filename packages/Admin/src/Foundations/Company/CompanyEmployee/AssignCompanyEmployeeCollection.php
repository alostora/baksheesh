<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Models\Company;

class AssignCompanyEmployeeCollection
{
    public static function assignCompanyEmployee($request, $user)
    {

        $validated = $request->validated();

        $validated['client_id'] = Company::find($validated['company_id'])->client_id;

        $user->update($validated);

        return $user;
    }
}
