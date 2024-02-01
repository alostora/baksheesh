<?php

namespace Admin\Foundations\Company\CompanyAvailableRating;

use App\Models\Company;
use App\Models\CompanyAvailableRating;

class CompanyAvailableRatingCreateCollection
{
    public static function createCompanyAvailableRating($request)
    {
        $validated = $request->validated();

        $validated['client_id'] = Company::find($validated['company_id'])->client_id;

        return CompanyAvailableRating::create($validated);
    }
}
