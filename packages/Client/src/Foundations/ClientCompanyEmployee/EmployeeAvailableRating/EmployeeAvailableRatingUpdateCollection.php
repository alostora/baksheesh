<?php

namespace Client\Foundations\ClientCompanyEmployee\EmployeeAvailableRating;


class EmployeeAvailableRatingUpdateCollection
{
    public static function updateEmployeeAvailableRating($request, $availableRating)
    {
        $validated = $request->validated();

        $availableRating->update($validated);

        return $availableRating;
    }
}
