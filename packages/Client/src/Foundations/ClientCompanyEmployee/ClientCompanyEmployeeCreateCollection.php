<?php

namespace Client\Foundations\ClientCompanyEmployee;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ClientCompanyEmployeeCreateCollection
{

    public static function createCompanyEmployee($request)
    {

        $lookup_account_type_employee = AccountTypeCollection::employee();

        $validated = $request->validated();

        $validated['user_account_type_id'] = $lookup_account_type_employee->id;

        $validated['client_id'] = auth()->id();

        $validated['password'] = Hash::make(Str::random(10));

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
        $user->ratingForGuest()->createMany($data);
    }
}
