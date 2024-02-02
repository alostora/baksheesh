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

            $company = Company::create($validated);

            if (isset($validated['file'])) {

                $validated['type'] = FileModuleType::COMPANY_PROFILE['key'];

                $validated['file_id'] = FileCreateCollection::createFile($validated)->id;

                unset($validated['type']);
            }

            return $company;
        }

        return false;
    }
}
