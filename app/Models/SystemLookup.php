<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLookup extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name',

        'name_ar',

        'prefix',

        'type',

        'key',

        'code',

    ];


    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) =>  app()->getLocale() == "en" ? $this->attributes['name'] : $this->attributes['name_ar'],
        );
    }


    final static public function findByType($type)
    {
        return SystemLookup::where('type', (int)$type)->get();
    }

    final static public function findByCode($type, $code)
    {
        return SystemLookup::where('type', (int)$type)
            ->where('code', (int)$code)
            ->first();
    }

    final static public function findByKey($type, $key)
    {
        return SystemLookup::where('type', (int)$type)
            ->where('key', $key)
            ->first();
    }
}
