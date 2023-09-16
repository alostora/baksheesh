<?php

namespace Client\Foundations\ClientCompany;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Models\Company;

class CompanyCreateCollection
{
    public static function createCompany($request)
    {
        $validated = $request->validated();

        if (isset($validated['file'])) {

            $validated['type'] = FileModuleType::COMPANY_PROFILE['key'];

            $validated['file_id'] = FileCreateCollection::createFile($validated)->id;

            unset($validated['type']);
        }
        
        $validated['client_id'] = auth()->id();

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
