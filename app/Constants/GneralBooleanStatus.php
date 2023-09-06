<?php

namespace App\Constants;

class GneralBooleanStatus
{

     public const TYPE_LIST = [
          0 => self::OFF,
          1 => self::ON
     ];

     public const OFF = [
          'code' => 0,
          'key' => 0,
          'prefix' => "OFF",
          'name' => 'Off'
     ];
     
     public const ON = [
          'code' => 1,
          'key' => 1,
          'prefix' => "ON",
          'name' => 'On'
     ];
     
}
