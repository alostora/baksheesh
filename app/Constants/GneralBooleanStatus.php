<?php

namespace App\Constants;

class GneralBooleanStatus
{

     public const TYPE_LIST = [
          0 => self::OFF,
          1 => self::ON,
          2 => self::SUCCESS,
          3 => self::FAILED,
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

     public const SUCCESS = [
          'code' => 2,
          'key' => 2,
          'prefix' => "SUCCESS",
          'name' => 'Success'
     ];
     
     public const FAILED = [
          'code' => 3,
          'key' => 3,
          'prefix' => "FAILED",
          'name' => 'Failed'
     ];
     
}
