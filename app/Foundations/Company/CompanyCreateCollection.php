<?php

namespace App\Foundations\Company;

use App\Constants\CompanyModuleType;
use App\Models\Company;

class CompanyCreateCollection
{
    public static function createCompany($request)
    {
        $validated = $request->validated();

        return Company::create($validated);
    }
}
