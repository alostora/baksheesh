<?php

namespace App\Constants\HasLookupType;

class AvailableEmployeeRating
{
     public const LOOKUP_TYPE = 6;

     public const RATING_LIST = [
          1 => self::CLEANLINEES_LEVEL,
          2 => self::BEHAVIOR_LEVEL,
          3 => self::ETHICS_LEVEL,
          4 => self::SERVICE_LEVEL,
          5 => self::PROFESSIONALISM_LEVEL,
     ];

     public const CLEANLINEES_LEVEL = [
          'code' => 1,
          'key' => 1,
          'prefix' => "CLEANLINEES_LEVEL",
          'name' => "CleanLiness",
          'name_ar' => "النظافة",
     ];

     public const BEHAVIOR_LEVEL = [
          'code' => 2,
          'key' => 2,
          'prefix' => "BEHAVIOR_LEVEL",
          'name' => "Behavior",
          'name_ar' => "السلوك",
     ];

     public const ETHICS_LEVEL = [
          'code' => 3,
          'key' => 3,
          'prefix' => "ETHICS_LEVEL",
          'name' => "Ethics",
          'name_ar' => "الاخلاق",
     ];

     public const SERVICE_LEVEL = [
          'code' => 4,
          'key' => 4,
          'prefix' => "SERVICE_LEVEL",
          'name' => "Service",
          'name_ar' => "الخدمة",
     ];

     public const PROFESSIONALISM_LEVEL = [
          'code' => 5,
          'key' => 5,
          'prefix' => "PROFESSIONALISM_LEVEL",
          'name' => "Professionalism",
          'name_ar' => "الاحترافية",
     ];
}
