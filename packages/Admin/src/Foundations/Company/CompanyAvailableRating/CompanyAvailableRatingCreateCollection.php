<?php

namespace Admin\Foundations\Company\CompanyAvailableRating;

use App\Models\CompanyAvailableRating;

class CompanyAvailableRatingCreateCollection
{
    public static function createCompanyAvailableRating($request)
    {
        return CompanyAvailableRating::create($request->validated());
    }

    public static function createCompanyAvailableRatingMultiable($request)
    {
        $validated = $request->validated();

        foreach ($validated['ratings'] as $rating) {

            CompanyAvailableRating::create([

                'client_id' => $validated['client_id'],

                'name' => $rating['name'],

                'name_ar' => $rating['name_ar'],
            ]);
        }
    }
}
