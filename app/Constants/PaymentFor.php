<?php

namespace App\Constants;

class PaymentFor
{

    public const TYPE_LIST = [
        1 => self::COMPANY,
        2 => self::EMPLOYEE,
    ];

    public const COMPANY = [
        'code' => 1,
        'key' => 1,
        'prefix' => "COMPANY",
        'name' => 'Company'
    ];

    public const EMPLOYEE = [
        'code' => 2,
        'key' => 2,
        'prefix' => "EMPLOYEE",
        'name' => 'Employee'
    ];
}
