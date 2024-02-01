<?php

namespace Admin\Foundations\Employee\EmployeeAvailableRating;


class EmployeeAvailableRatingUpdateCollection
{
    public static function updateEmployeeAvailableRating($request, $availableRating)
    {
        $validated = $request->validated();

        $availableRating->update($validated);

        return $availableRating;
    }
}
