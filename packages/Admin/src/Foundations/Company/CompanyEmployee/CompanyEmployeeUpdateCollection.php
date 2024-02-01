<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\File\FileDeleteCollection;
use App\Models\Company;
use App\Models\File;

class CompanyEmployeeUpdateCollection
{
    public static function updateCompanyEmployee($request, $user)
    {

        $validated = $request->validated();

        if (isset($validated['file'])) {

            if ($user->file_id) {

                FileDeleteCollection::deleteFile(File::find($user->file_id));
            }

            $validated['type'] = FileModuleType::USER_PROFILE_AVATAR['key'];

            $validated['file_id'] = FileCreateCollection::createFile($validated)->id;

            unset($validated['type']);
        }

        if (empty($validated['password'])) {

            unset($validated['password']);
        }

        $validated['client_id'] = Company::find($validated['company_id'])->client_id;

        $user->update($validated);

        return $user;
    }
}
