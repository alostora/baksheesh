<?php

namespace Admin\Foundations\Company;

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

        $company = Company::create($validated);

        return $company;
    }
}
