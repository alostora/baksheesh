<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingForGuest extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [

        'client_id',

        'company_id',

        'employee_id',

        'available_rating_id',

        'stopped_at',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('Y-m-d', strtotime($value)),
        );
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function companyAvailableRating(): BelongsTo
    {
        return $this->belongsTo(CompanyAvailableRating::class, 'available_rating_id', 'id');
    }

    public function employeeAvailableRating(): BelongsTo
    {
        return $this->belongsTo(EmployeeAvailableRating::class, 'available_rating_id', 'id');
    }
}
