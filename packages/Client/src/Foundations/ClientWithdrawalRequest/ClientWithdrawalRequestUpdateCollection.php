<?php

namespace Client\Foundations\ClientWithdrawalRequest;


class ClientWithdrawalRequestUpdateCollection
{
    public static function updateClientWithdrawalRequest($request, $user)
    {

        $validated = $request->validated();

        $user->update($validated);

        return $user;
    }
}
