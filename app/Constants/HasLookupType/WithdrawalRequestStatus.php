<?php

namespace App\Constants\HasLookupType;

class WithdrawalRequestStatus
{
     public const LOOKUP_TYPE = 4;

     public const STATUS_LIST = [
          1 => self::PENDING,
          2 => self::ACCEPTED,
          3 => self::REFUSED,
          4 => self::IMPLEMENTED,
          5 => self::UNEXECUTABLE,
     ];

     public const PENDING = [
          'code' => 1,
          'key' => "1",
          'prefix' => 'PENDING',
          'name' => "Pending",
          'name_ar' => "انتظار",
     ];

     public const ACCEPTED = [
          'code' => 2,
          'key' => "2",
          'prefix' => 'ACCEPTED',
          'name' => "Accepted",
          'name_ar' => "تمت الموافقة",
     ];

     public const REFUSED = [
          'code' => 3,
          'key' => "3",
          'prefix' => 'REFUSED',
          'name' => "Refused",
          'name_ar' => "مرفوض",
     ];

     public const IMPLEMENTED = [
          'code' => 4,
          'key' => "4",
          'prefix' => 'IMPLEMENTED',
          'name' => "Implemented",
          'name_ar' => "تم التنفيذ",
     ];

     public const UNEXECUTABLE = [
          'code' => 5,
          'key' => "5",
          'prefix' => 'UNEXECUTABLE',
          'name' => "Unexecutable",
          'name_ar' => "تعذر التنفيذ",
     ];
}
