<?php

namespace Admin\Foundations\Company;

use App\Foundations\File\FileDeleteCollection;
use App\Models\Company;
use App\Models\File;

class CompanyUpdateApiCollection
{
    public static function updateCompany($request, $company)
    {
        $validated = $request->validated();

        if (isset($validated['file_id'])) {

            if ($company->file_id) {

                FileDeleteCollection::deleteFile(File::find($company->file_id));
            }
        }

        $company->update($validated);

        if (isset($validated['available_rating_ids'])) {
            self::updateAvailableRating($validated['available_rating_ids'], $company);
        }

        return $company;
    }

    public static function updateAvailableRating($available_rating_ids, Company $company)
    {
        $company->companyAvailableRatings()->delete();

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
