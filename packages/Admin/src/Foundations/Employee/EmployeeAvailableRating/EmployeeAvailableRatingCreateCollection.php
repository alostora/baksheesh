<?php

namespace Admin\Foundations\Employee\EmployeeAvailableRating;

use App\Models\Company;
use App\Models\EmployeeAvailableRating;
use App\Models\User;

class EmployeeAvailableRatingCreateCollection
{
    public static function createEmployeeAvailableRating($request)
    {
        $validated = $request->validated();

        $employee = User::find($validated['employee_id']);

        $company = Company::find($employee->company_id);

        $validated['client_id'] = $company->client_id;

        $validated['company_id'] = $company->id;

        return EmployeeAvailableRating::create($validated);
    }
}
