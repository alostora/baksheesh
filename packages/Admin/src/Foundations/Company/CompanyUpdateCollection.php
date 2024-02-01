<?php

namespace Admin\Foundations\Company;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\File\FileDeleteCollection;
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

        return $company;
    }
}
