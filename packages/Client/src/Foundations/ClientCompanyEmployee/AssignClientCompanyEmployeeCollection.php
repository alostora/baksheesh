<?php

namespace Client\Foundations\ClientCompanyEmployee;

class AssignClientCompanyEmployeeCollection
{
    public static function assignCompanyEmployee($request, $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return $user;
    }
}
