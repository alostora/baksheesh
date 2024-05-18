<?php

namespace Client\Foundations;


class Collection
{
    public static function getNetAmount($amount)
    {

        return ($amount->sum('amount') - (2 * $amount->count())) / 1.05;
    }
}
