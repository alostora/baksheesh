<?php

namespace Client\Foundations\ClientCompanyEmployee\EmployeeAvailableRating;

use App\Models\EmployeeAvailableRating;

class EmployeeAvailableRatingCreateCollection
{
    public static function createEmployeeAvailableRating($request)
    {
        $validated = $request->validated();

        $validated['client_id'] = auth()->id();

        return EmployeeAvailableRating::create($validated);
    }
}
