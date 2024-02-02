<?php

namespace Client\Foundations\ClientCompany\CompanyAvailableRating;

use App\Models\CompanyAvailableRating;

class CompanyAvailableRatingCreateCollection
{
    public static function createCompanyAvailableRating($request)
    {
        $validated = $request->validated();

        $validated['client_id'] = auth()->id();

        return CompanyAvailableRating::create($validated);
    }
}
