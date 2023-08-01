<?php

namespace App\Foundations\ClientSystemMode;

use App\Models\ClientSystemMode;
use App\Models\ClientSystemModeDuration;

class ClientSystemModeDurationQueryCollection

{
    public static function searchAllClientSystemModeDurations(
        ClientSystemMode $clientSystemMode,
    ) {
        return ClientSystemModeDuration::where('client_system_mode_id', $clientSystemMode->id)
            ->orderBy('created_at', 'desc');
    }
}
