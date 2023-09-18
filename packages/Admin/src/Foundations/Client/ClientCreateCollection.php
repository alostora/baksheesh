<?php

namespace Admin\Foundations\Client;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\LookupType\AccountTypeCollection;
use App\Models\User;

class ClientCreateCollection
{
    public static function createClient($request)
    {

        $user_account_type = AccountTypeCollection::client();

        $validated = $request->validated();

        $validated['user_account_type_id'] = $user_account_type->id;

        if (isset($validated['file'])) {

            $validated['type'] = FileModuleType::USER_PROFILE_AVATAR['key'];

            $validated['file_id'] = FileCreateCollection::createFile($validated)->id;

            unset($validated['type']);
        }

        $user = User::create($validated);

        return $user;
    }
}
