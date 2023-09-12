<?php

namespace App\Constants\HasLookupType;

class LookupType
{
    public const LOOKUP_TYPES = [

        1 => "UserAccountType",
        2 => "CountryType",
        3 => "AllowedLanguages",
        4 => "WithdrawalRequestStatus",
        5 => "AvailableCompanyRating",
        6 => "AvailableEmployeeRating",
    ];

    const UserAccountType = 1;
    const CountryType = 2;
    const AllowedLanguages = 3;
    const WithdrawalRequestStatus = 4;
    const AvailableCompanyRating = 5;
    const AvailableEmployeeRating = 6;
}
