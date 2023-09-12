<?php

namespace App\Constants\HasLookupType;

class AvailableCompanyRating
{
     public const LOOKUP_TYPE = 5;

     public const RATING_LIST = [
          1 => self::CLEANLINEES_LEVEL,
          2 => self::SERVICE_LEVEL,
          3 => self::PRICE_LEVEL,
          4 => self::PRODUCT_QUALITY_LEVEL,
     ];

     public const CLEANLINEES_LEVEL = [
          'code' => 1,
          'key' => 1,
          'prefix' => "CLEANLINEES_LEVEL",
          'name' => "CleanLiness Level",
          'name_ar' => "مستوي النظافة",
     ];

     public const SERVICE_LEVEL = [
          'code' => 2,
          'key' => 2,
          'prefix' => "SERVICE_LEVEL",
          'name' => "Service Level",
          'name_ar' => "مستوي الخدمة",
     ];

     public const PRICE_LEVEL = [
          'code' => 3,
          'key' => 3,
          'prefix' => "PRICE_LEVEL",
          'name' => "Price Level",
          'name_ar' => "مستوي الاسعار",
     ];

     public const PRODUCT_QUALITY_LEVEL = [
          'code' => 4,
          'key' => 4,
          'prefix' => "PRODUCT_QUALITY_LEVEL",
          'name' => "Product Quality Level",
          'name_ar' => "مستوي جوده المنتج",
     ];
}
