<?php

namespace App\Constants\HasLookupType;

class LookupType
{
    public const LOOKUP_TYPES = [

        1 => "userAccountType",
        2 => "countryType",
        3 => "allowedLanguages",
        4 => "withdrawalRequestStatus",
    ];

    const userAccountType = 1;
    const countryType = 2;
    const allowedLanguages = 3;
    const WithdrawalRequestStatus = 4;
}
