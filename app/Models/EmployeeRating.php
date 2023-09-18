<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeRating extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [

        'guest_ip',

        'client_id',

        'company_id',

        'employee_id',

        'rating_id',

        'rating_value',

    ];

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

    public function availableRating(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'rating_id', 'id');
    }
}
