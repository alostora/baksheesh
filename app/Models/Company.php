<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Company extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [

        'name',

        'client_id',

        'company_field',

        'file_id',

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

    protected $appends = [
        'company_qr'
    ];

    public function getCompanyQrAttribute()
    {
        return QrCode::size(100)->generate(url('guest/payment/pay-for-company/' . $this->id));
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }

    public function cash(): HasMany
    {
        return $this->hasMany(CompanyCash::class, 'company_id', 'id');
    }


    //for select inside client create company
    public function companyAvailableRatings(): HasMany
    {
        return $this->hasMany(CompanyAvailableRating::class, 'client_id', 'id');
    }

    //for select inside guest payment
    public function ratingForGuest(): HasMany
    {
        return $this->hasMany(RatingForGuest::class, 'company_id', 'id')
            ->where('stopped_at', null);
    }

    public function companyGoodRating(): HasMany
    {
        return $this->hasMany(CompanyRating::class, 'company_id', 'id')->where('rating_value', 2);
    }

    public function companyBadRating(): HasMany
    {
        return $this->hasMany(CompanyRating::class, 'company_id', 'id')->where('rating_value', 1);
    }

    public function companyTotalRating()
    {

        $ratingForGuestRatedBad = $this->ratingForGuest()
            ->whereIn('available_rating_id', $this->companyBadRating()->pluck('rating_id'))
            ->count();

        $ratingForGuestRatedGood = $this->ratingForGuest()
            ->whereIn('available_rating_id', $this->companyGoodRating()->pluck('rating_id'))
            ->count();


        if ($ratingForGuestRatedBad != 0 && $ratingForGuestRatedGood != 0) {

            return ($this->companyBadRating()->count() / $ratingForGuestRatedBad)

                -

                ($this->companyGoodRating()->count() / $ratingForGuestRatedGood);
        }
    }
}
