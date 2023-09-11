<?php

namespace App\Foundations\LookupType;


use App\Constants\HasLookupType\WithdrawalRequestStatus;
use App\Models\SystemLookup;

class WithdrawalRequestStatusCollection

{

     public static function statusList()
     {
          return SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)->get();
     }

     public static function pending()
     {
          return SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
               ->where('code', WithdrawalRequestStatus::PENDING['code'])
               ->first();
     }

     public static function accepted()
     {
          return SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
               ->where('code', WithdrawalRequestStatus::ACCEPTED['code'])
               ->first();
     }

     public static function refused()
     {
          return SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
               ->where('code', WithdrawalRequestStatus::REFUSED['code'])
               ->first();
     }

     public static function implemented()
     {
          return SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
               ->where('code', WithdrawalRequestStatus::IMPLEMENTED['code'])
               ->first();
     }

     public static function unexecutable()
     {
          return SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
               ->where('code', WithdrawalRequestStatus::UNEXECUTABLE['code'])
               ->first();
     }
}
