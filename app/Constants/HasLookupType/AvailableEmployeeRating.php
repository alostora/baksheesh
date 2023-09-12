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
          'name' => "CleanLiness Level",
          'name_ar' => "مستوي النظافة",
     ];

     public const BEHAVIOR_LEVEL = [
          'code' => 2,
          'key' => 2,
          'prefix' => "BEHAVIOR_LEVEL",
          'name' => "Behavior Level",
          'name_ar' => "مستوي السلوك",
     ];

     public const ETHICS_LEVEL = [
          'code' => 3,
          'key' => 3,
          'prefix' => "ETHICS_LEVEL",
          'name' => "Ethics Level",
          'name_ar' => "مستوي الاخلاق",
     ];

     public const SERVICE_LEVEL = [
          'code' => 4,
          'key' => 4,
          'prefix' => "SERVICE_LEVEL",
          'name' => "Service Level",
          'name_ar' => "مستوي الخدمة",
     ];

     public const PROFESSIONALISM_LEVEL = [
          'code' => 5,
          'key' => 5,
          'prefix' => "PROFESSIONALISM_LEVEL",
          'name' => "Professionalism Level",
          'name_ar' => "مستوي الاحترافية",
     ];
}
