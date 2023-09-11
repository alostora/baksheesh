<?php

namespace App\Foundations\LookupType;


use App\Constants\HasLookupType\UserAccountType;
use App\Models\SystemLookup;

class AccountTypeCollection

{
     public static function typeList()
     {
          return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
               ->get();
     }

     public static function typeListExceptEmployee()
     {
          return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
               ->where('code', '!=', UserAccountType::EMPLOYEE['code'])
               ->get();
     }

     public static function root()
     {
          return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
               ->where('code',  UserAccountType::ROOT['code'])
               ->first();
     }

     public static function admin()
     {
          return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
               ->where('code',  UserAccountType::ADMIN['code'])
               ->first();
     }

     public static function client()
     {
          return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
               ->where('code',  UserAccountType::CLIENT['code'])
               ->first();
     }

     public static function employee()
     {

          return SystemLookup::where('type', UserAccountType::LOOKUP_TYPE)
               ->where('code',  UserAccountType::EMPLOYEE['code'])
               ->first();
     }
}
