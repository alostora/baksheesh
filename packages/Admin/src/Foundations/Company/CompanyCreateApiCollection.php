<?php

namespace Admin\Foundations\Company;

use App\Models\Company;

class CompanyCreateApiCollection
{
    public static function createCompany($request)
    {
        $validated = $request->validated();

        $company = Company::create($validated);

        if (isset($validated['available_rating_ids'])) {
            self::createAvailableRating($validated['available_rating_ids'], $company);
        }

        return $company;
    }

    public static function createAvailableRating($available_rating_ids, Company $company)
    {

        foreach ($available_rating_ids as $available_rating_id) {
            $data[] = [
                "client_id" => $company->client_id,
                "company_id" => $company->id,
                "available_rating_id" => $available_rating_id,
            ];
        }
        $company->companyAvailableRatings()->createMany($data);
    }
}
