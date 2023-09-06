<?php

namespace App\Constants;

class GneralBooleanActiveStatus
{

     public const TYPE_LIST = [
          0 => self::INACTIVE,
          1 => self::ACTIVE
     ];

     public const INACTIVE = [
          'code' => 0,
          'key' => 0,
          'prefix' => "INACTIVE",
          'name' => 'Inactive'
     ];

     public const ACTIVE = [
          'code' => 1,
          'key' => 1,
          'prefix' => "ACTIVE",
          'name' => 'Active'
     ];
}
