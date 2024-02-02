<?php

namespace Admin\Foundations\Company;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Models\Company;
use App\Models\User;

class CompanyCreateCollection
{
    public static function createCompany($request)
    {
        $validated = $request->validated();

        $client = User::find($validated['client_id']);

        if ($client->companies->count() < $client->available_companies_count) {

            if (isset($validated['file'])) {

                $validated['type'] = FileModuleType::COMPANY_PROFILE['key'];

                $validated['file_id'] = FileCreateCollection::createFile($validated)->id;

                unset($validated['type']);
            }

            $company = Company::create($validated);

            if (isset($validated['available_rating_ids'])) {
                self::createAvailableRating($validated['available_rating_ids'], $company);
            }

            return $company;
        }

        return false;
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

        $company->ratingForGuest()->createMany($data);
    }
}
