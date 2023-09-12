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

        'email',

        'password',

        'phone',

        'address',

        'api_token',

        "available_companies_count",

        "available_employees_count",

        'country_id',

        'user_account_type_id', //lookup type

        'client_id', //company owner

        'company_id',

        'file_id',

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
        return $this->hasMany(User::class, 'client_id', 'id');
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'client_id', 'id');
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

    public function acceptedWithdrawal(): HasMany
    {
        $accpted_withdrawalRequest = SystemLookup::where('type', WithdrawalRequestStatus::LOOKUP_TYPE)
            ->where('code', WithdrawalRequestStatus::ACCEPTED['code'])
            ->first();

        return $this->hasMany(ClientWithdrawalRequest::class, 'client_id', 'id')->where('status', $accpted_withdrawalRequest->id);
    }
    
    public function employeeAvailableRatings(): HasMany
    {
        return $this->hasMany(EmployeeAvailableRating::class, 'employee_id', 'id');
    }
}
