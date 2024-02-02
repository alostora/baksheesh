<?php

namespace Admin\Foundations\Company\CompanyEmployee;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class CompanyEmployeeCreateCollection
{
    public static function createCompanyEmployee($request)
    {

        $validated = $request->validated();

        $validated['client_id'] = Company::find($validated['company_id'])->client_id;

        $validated['password'] = Hash::make(Str::random(10));

        $client = User::find($validated['client_id']);

        if ($client->employees->count() < $client->available_employees_count) {

            $validated['user_account_type_id'] = AccountTypeCollection::employee()->id;

            if (isset($validated['file'])) {

                $validated['type'] = FileModuleType::USER_PROFILE_AVATAR['key'];

                $validated['file_id'] = FileCreateCollection::createFile($validated)->id;

                unset($validated['type']);
            }

            $user = User::create($validated);

            if (isset($validated['available_rating_ids'])) {
                self::createAvailableRating($validated['available_rating_ids'], $user);
            }

            return $user;
        }

        return false;
    }


    public static function createAvailableRating($available_rating_ids, User $user)
    {

        foreach ($available_rating_ids as $available_rating_id) {
            $data[] = [
                "client_id" => $user->client_id,
                "employee_id" => $user->id,
                "available_rating_id" => $available_rating_id,
            ];
        }

        $user->ratingForGuest()->createMany($data);
    }
}
