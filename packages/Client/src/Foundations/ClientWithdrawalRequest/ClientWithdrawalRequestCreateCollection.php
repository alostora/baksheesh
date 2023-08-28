<?php

namespace Client\Foundations\ClientWithdrawalRequest;

use App\Constants\HasLookupType\WithdrawalRequestStatus;
use App\Models\ClientWithdrawalRequest;
use App\Models\SystemLookup;

class ClientWithdrawalRequestCreateCollection
{
    public static function createClientWithdrawalRequest($request)
    {

        $system_lookup = SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
            ->where('code', WithdrawalRequestStatus::PENDING['code'])
            ->first();

        $validated = $request->validated();

        $validated['client_id'] = auth()->id();

        $validated['status'] = $system_lookup->id;

        return ClientWithdrawalRequest::create($validated);
    }
}
