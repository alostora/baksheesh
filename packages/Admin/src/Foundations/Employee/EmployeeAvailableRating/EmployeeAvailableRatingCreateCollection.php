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
}
