<?php

namespace Admin\Foundations\Company\CompanyAvailableRating;

use App\Models\Company;
use App\Models\CompanyAvailableRating;

class CompanyAvailableRatingCreateCollection
{
    public static function createCompanyAvailableRating($request)
    {
        return CompanyAvailableRating::create($request->validated());
    }
}
