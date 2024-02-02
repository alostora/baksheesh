<?php

namespace Client\Foundations\ClientCompany;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\File\FileDeleteCollection;
use App\Models\Company;
use App\Models\File;

class CompanyUpdateCollection
{
    public static function updateCompany($request, $company)
    {
        $validated = $request->validated();

        if (isset($validated['file'])) {

            if ($company->file_id) {

                FileDeleteCollection::deleteFile(File::find($company->file_id));
            }

            $validated['type'] = FileModuleType::COMPANY_PROFILE['key'];

            $validated['file_id'] = FileCreateCollection::createFile($validated)->id;

            unset($validated['type']);
        }

        $company->update($validated);

        if (isset($validated['available_rating_ids'])) {
            self::updateAvailableRating($validated['available_rating_ids'], $company);
        }

        return $company;
    }

    public static function updateAvailableRating($available_rating_ids, Company $company)
    {
        $company->ratingForGuest()->delete();

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
