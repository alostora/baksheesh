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

    public static function createCompanyAvailableRatingMultiable($request)
    {
        $validated = $request->validated();

        foreach ($validated['ratings'] as $rating) {

            CompanyAvailableRating::create([

                'client_id' => auth()->id(),

                'name' => $rating['name'],

                'name_ar' => $rating['name_ar'],
            ]);
        }
    }
}
