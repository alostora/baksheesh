<?php

namespace App\Constants;

class FileModuleType
{

     public const TYPE_LIST = [
          0 => self::DEFAULT_USER_AVATAR,
          1 => self::USER_PROFILE_AVATAR,
          2 => self::COMPANY_PROFILE,
     ];

     public const DEFAULT_USER_AVATAR = [
          'code' => 0,
          'key' => 0,
          'prefix' => "DEFAULT_USER_AVATAR",
          'name' => 'Default user avatar'
     ];
     
     public const USER_PROFILE_AVATAR = [
          'code' => 1,
          'key' => 1,
          'prefix' => "USER_PROFILE_AVATAR",
          'name' => 'User avatar'
     ];
     
     public const COMPANY_PROFILE = [
          'code' => 2,
          'key' => 2,
          'prefix' => "COMPANY_PROFILE",
          'name' => 'Company profile'
     ];
}
