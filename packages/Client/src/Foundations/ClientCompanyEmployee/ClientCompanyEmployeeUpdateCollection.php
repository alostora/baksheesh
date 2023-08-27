<?php

namespace Client\Foundations\ClientCompanyEmployee;

class ClientCompanyEmployeeUpdateCollection
{
    public static function updateCompanyEmployee($request, $user)
    {

        $validated = $request->validated();

        $user->update($validated);

        return $user;
    }
}
