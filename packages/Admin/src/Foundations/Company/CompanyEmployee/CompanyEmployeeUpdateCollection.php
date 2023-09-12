<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Models\Company;
use App\Models\User;

class CompanyEmployeeUpdateCollection
{
    public static function updateCompanyEmployee($request, $user)
    {

        $validated = $request->validated();

        $validated['client_id'] = Company::find($validated['company_id'])->client_id;

        $user->update($validated);


        if (isset($validated['available_rating_ids'])) {
            self::updateAvailableRating($validated['available_rating_ids'], $user);
        }
        return $user;
    }
    
    public static function updateAvailableRating($available_rating_ids, User $user)
    {
        $user->employeeAvailableRatings()->delete();

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
