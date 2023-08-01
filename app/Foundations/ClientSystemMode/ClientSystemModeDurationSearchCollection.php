<?php

namespace App\Foundations\ClientSystemMode;

use App\Constants\SystemDefault;
use App\Models\ClientSystemMode;

class ClientSystemModeDurationSearchCollection

{
    public static function searchClientSystemModeDurations(
        ClientSystemMode $clientSystemMode,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT
    ) {
        $users = ClientSystemModeDurationQueryCollection::searchAllClientSystemModeDurations($clientSystemMode);

        return $users->paginate($per_page);
    }
}
