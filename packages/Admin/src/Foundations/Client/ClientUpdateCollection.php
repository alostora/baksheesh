<?php

namespace Admin\Foundations\Client;

use App\Constants\FileModuleType;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\File\FileDeleteCollection;
use App\Models\File;

class ClientUpdateCollection
{
    public static function updateClient($request, $user)
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

        $user->update($validated);

        return $user;
    }
}
