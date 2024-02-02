<?php

namespace Client\Foundations\ClientCompanyEmployee;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\File\FileDeleteCollection;
use App\Models\File;
use App\Models\User;

class ClientCompanyEmployeeUpdateCollection
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

        $user->update($validated);

        if (isset($validated['available_rating_ids'])) {
            self::updateAvailableRating($validated['available_rating_ids'], $user);
        }

        return $user;
    }

    public static function updateAvailableRating($available_rating_ids, User $user)
    {
        $user->ratingForGuest()->delete();

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
