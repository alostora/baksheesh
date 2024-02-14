<?php

namespace Admin\Foundations\Employee\EmployeeAvailableRating;

use App\Models\Company;
use App\Models\EmployeeAvailableRating;
use App\Models\User;

class EmployeeAvailableRatingCreateCollection
{
    public static function createEmployeeAvailableRating($request)
    {
        return EmployeeAvailableRating::create($request->validated());
    }

    public static function createEmployeeAvailableRatingMultiable($request)
    {
        $validated = $request->validated();

        foreach ($validated['ratings'] as $rating) {

            EmployeeAvailableRating::create([

                'client_id' => $validated['client_id'],

                'name' => $rating['name'],

                'name_ar' => $rating['name_ar'],
            ]);
        }
    }
}
