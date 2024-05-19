<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeCash extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [

        'client_id',

        'company_id',

        'employee_id',

        'amount',

        'payer_name',

        'payer_email',

        'payer_phone',

        'notes',

        'guest_key',

    ];

    protected $appends = [

        'net_amount'
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

    public function getNetamountAttribute()
    {
        if ($this->amount > 0) {
            return ($this->amount - 2) / 1.05;
        }
        return 0;
    }
}
