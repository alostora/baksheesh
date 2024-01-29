<?php

namespace App\Models;

use App\Constants\HasLookupType\CountryType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name',

        'name_ar',

        'phone_code',

        'flag',

        'prefix',

        'longitude',

        'latitude',

        'type',

        'country_id',

        'governorate_id',

        'city_id',

        'zone_id',

        'stopped_at',

    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('Y-m-d', strtotime($value)),
        );
    }
    protected $casts = [

        'stopped_at' => 'datetime'
    ];

    // protected function name(): Attribute
    // {

    //     return Attribute::make(
    //         //get: fn (string $value) => $this->attributes['name'],
    //         get: fn (string $value) =>  app()->getLocale() == "en" ? $this->attributes['name'] : $this->attributes['name_ar'],
    //     );
    // }

    final static public function loadCountry($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::COUNTRY['code'])
            ->first();
    }

    final static public function loadGovernorate($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::GOVERNORATE['code'])
            ->first();
    }

    final static public function loadCity($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::CITY['code'])
            ->first();
    }

    final static public function loadZone($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::ZONE['code'])
            ->first();
    }

    final static public function loadDistrict($id)
    {
        return Country::where('id', $id)
            ->where('type', CountryType::DISTRICT['code'])
            ->first();
    }

    /* HasMany */
    public function governorates(): HasMany
    {
        return $this->hasMany(Country::class, 'country_id', 'id')
            ->where('type', CountryType::GOVERNORATE['code'])
            ->where('stopped_at', null);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(Country::class, 'country_id', 'id')
            ->where('type', CountryType::CITY['code']);
    }

    public function zones(): HasMany
    {
        return $this->hasMany(Country::class, 'country_id', 'id')
            ->where('type', CountryType::ZONE['code']);
    }

    public function districts(): HasMany
    {
        return $this->hasMany(Country::class, 'country_id', 'id')
            ->where('type', CountryType::DISTRICT['code']);
    }

    /* BelongsTo */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id')
            ->where('type', CountryType::COUNTRY['code']);
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'governorate_id', 'id')
            ->where('type', CountryType::GOVERNORATE['code']);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'city_id', 'id')
            ->where('type', CountryType::CITY['code']);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'zone_id', 'id')
            ->where('type', CountryType::ZONE['code']);
    }
}
