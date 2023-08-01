<?php

namespace App\Foundations\ClientSystemMode;

use App\Constants\FileModuleType;
use App\Models\ClientSystemModeDuration;
use App\Models\File;

class ClientSystemModeDurationCreateCollection
{
    public static function createClientSystemModeDuration($validated)
    {
        return ClientSystemModeDuration::create($validated);
    }
}
