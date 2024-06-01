<?php

namespace App\Models;

use App\Constants\HasLookupType\WithdrawalRequestStatus;
use App\Notifications\ResetPasswordEmail;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [

        'name',

        'phone',

        'email',

        'password',

        'address',

        "available_companies_count",

        "available_employees_count",

        'country_id',

        'governorate_id',

        "employee_job_name",

        'user_account_type_id',

        'client_id',

        'company_id',

        'file_id',

        'api_token',

        'email_verification_code',

        'reset_password_code',

        'email_verified_at',

        'stopped_at',

    ];

    protected $hidden = [

        'password',

        'api_token',

        'remember_token',
    ];

    protected $casts = [

        'email_verified_at' => 'datetime',

        'stopped_at' => 'datetime'
    ];

    protected $appends = [
        'employee_qr',
        'employee_total_rating',
    ];

    public function getEmployeeQrAttribute()
    {
        return QrCode::size(100)->generate(url('guest/payment/pay-for-employee/' . $this->id));
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('Y-m-d', strtotime($value)),
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendResetPasswordCodeNotification()
    {
        $this->notify(new ResetPasswordEmail);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'governorate_id', 'id');
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'user_account_type_id', 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }


    public function employees(): HasMany
    {
        return $this->hasMany(User::class, 'client_id', 'id')
            ->where('stopped_at', null);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'client_id', 'id')
            ->where('stopped_at', null);
    }

    public function employeeCash(): HasMany
    {
        return $this->hasMany(EmployeeCash::class, 'employee_id', 'id');
    }

    public function clientEmployeeCash(): HasMany
    {
        return $this->hasMany(EmployeeCash::class, 'client_id', 'id');
    }

    public function clientCompanyCash(): HasMany
    {
        return $this->hasMany(CompanyCash::class, 'client_id', 'id');
    }

    public function withdrawalRequests(): HasMany
    {
        return $this->hasMany(ClientWithdrawalRequest::class, 'client_id', 'id')
            ->where('stopped_at', null);
    }

    public function acceptedWithdrawal(): HasMany
    {
        $accpted_withdrawalRequest = SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
            ->where('code', WithdrawalRequestStatus::ACCEPTED['code'])
            ->first();

        return $this->hasMany(ClientWithdrawalRequest::class, 'client_id', 'id')
            ->where('status', $accpted_withdrawalRequest->id);
    }

    //for select inside client create company
    public function companyAvailableRatings(): HasMany
    {
        return $this->hasMany(CompanyAvailableRating::class, 'client_id', 'id')
            ->where('stopped_at', null);
    }

    public function employeeAvailableRatings(): HasMany
    {
        return $this->hasMany(EmployeeAvailableRating::class, 'client_id', 'id')
            ->where('stopped_at', null);
    }

    //for select inside guest payment
    public function ratingForGuest(): HasMany
    {
        return $this->hasMany(RatingForGuest::class, 'employee_id', 'id')

            ->whereHas('employeeAvailableRating', function ($q) {

                $q
                    ->where('stopped_at', null);
            })
            ->where('stopped_at', null);
    }

    public function employeeGoodRating(): HasMany
    {
        return $this->hasMany(EmployeeRating::class, 'employee_id', 'id')->where('rating_value', 2);
    }

    public function employeeBadRating(): HasMany
    {
        return $this->hasMany(EmployeeRating::class, 'employee_id', 'id')->where('rating_value', 1);
    }

    public function getEmployeeTotalRatingAttribute()
    {

        $total_good_percent = 0;

        $all_available_ratings = $this->employeeGoodRating()->count() + $this->employeeBadRating()->count();

        if ($all_available_ratings != 0) {

            $total_good_percent = ($this->employeeGoodRating()->count() / $all_available_ratings) * 100;
        }

        return $total_good_percent;
    }
}
