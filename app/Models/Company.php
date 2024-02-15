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
        'company_qr',
        'company_total_rating',
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

    public function getCompanyTotalRatingAttribute()
    {

        $total_good_percent = 100;

        $all_available_ratings = $this->ratingForGuest()->count();


        if ($all_available_ratings != 0) {
            $total_good_percent = ((($this->companyGoodRating()->count() / $all_available_ratings)) * 100) / 5;
        }

        return ceil($total_good_percent);
    }
}
