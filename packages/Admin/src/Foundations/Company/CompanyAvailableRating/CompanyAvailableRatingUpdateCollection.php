<?php

namespace Admin\Foundations\Company\CompanyAvailableRating;


class CompanyAvailableRatingUpdateCollection
{
    public static function updateCompanyAvailableRating($request, $availableRating)
    {
        $validated = $request->validated();

        $availableRating->update($validated);

        return $availableRating;
    }
}
