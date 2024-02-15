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


    public static function createEmployeeAvailableRatingMultiable($request)
    {
        $validated = $request->validated();

        foreach ($validated['ratings'] as $rating) {

            EmployeeAvailableRating::create([

                'client_id' => auth()->id(),

                'name' => $rating['name'],

                'name_ar' => $rating['name_ar'],
            ]);
        }
    }
}
