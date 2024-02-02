<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\User;

class CompanyEmployeeCreateCollection
{
    public static function createCompanyEmployee($request)
    {

        $validated = $request->validated();

        $validated['client_id'] = Company::find($validated['company_id'])->client_id;

        $client = User::find($validated['client_id']);

        if ($client->employees->count() < $client->available_employees_count) {

            $validated['user_account_type_id'] = AccountTypeCollection::employee()->id;

            if (isset($validated['file'])) {

                $validated['type'] = FileModuleType::USER_PROFILE_AVATAR['key'];

                $validated['file_id'] = FileCreateCollection::createFile($validated)->id;

                unset($validated['type']);
            }

            $user = User::create($validated);

            return $user;
        }

        return false;
    }
}
