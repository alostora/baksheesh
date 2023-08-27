<?php

namespace Client\Foundations\ClientEmployee;


class ClientEmployeeUpdateCollection
{
    public static function updateClientEmployee($request, $user)
    {

        $validated = $request->validated();

        $user->update($validated);

        return $user;
    }
}
