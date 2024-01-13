<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\User;

class CompanyEmployeeCreateApiCollection
{
    public static function createCompanyEmployee($request)
    {

        $validated = $request->validated();

        $validated['user_account_type_id'] = AccountTypeCollection::employee()->id;

        $validated['client_id'] = Company::find($validated['company_id'])->client_id;

        $user = User::create($validated);

        if (isset($validated['available_rating_ids'])) {

            self::createAvailableRating($validated['available_rating_ids'], $user);
        }

        return $user;
    }

    public static function createAvailableRating($available_rating_ids, User $user)
    {

        foreach ($available_rating_ids as $available_rating_id) {
            $data[] = [
                "client_id" => $user->client_id,
                "company_id" => $user->company_id,
                "employee_id" => $user->id,
                "available_rating_id" => $available_rating_id,
            ];
        }
        $user->employeeAvailableRatings()->createMany($data);
    }
}
