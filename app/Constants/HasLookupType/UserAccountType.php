<?php

namespace App\Constants\HasLookupType;

class UserAccountType
{
     public const LOOKUP_TYPE = 1;

     public const TYPE_LIST = [
          1 => self::ROOT,
          2 => self::ADMIN,
          3 => self::CLIENT,
          4 => self::WAITER,
     ];

     public const ROOT = [
          'code' => 1,
          'key' => 1,
          'prefix' => "ROOT",
          'name' => "Root",
          'name_ar' => "سوبر ادمن",
     ];

     public const ADMIN = [
          'code' => 2,
          'key' => 2,
          'prefix' => "ADMIN",
          'name' => "Admin",
          'name_ar' => "أدمن",
     ];

     public const CLIENT = [
          'code' => 3,
          'key' => 3,
          'prefix' => "CLIENT",
          'name' => "Client",
          'name_ar' => "عميل",
     ];
     
     public const WAITER = [
          'code' => 4,
          'key' => 4,
          'prefix' => "WAITER",
          'name' => "waiter",
          'name_ar' => "النادل",
     ];
}
