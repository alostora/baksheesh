<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAvailableRating extends Model
{
    use HasFactory, HasUuids/* , SoftDeletes */;

    protected $fillable = [

        'client_id',

        'company_id',

        'employee_id',

        'available_rating_id',

    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(User::class, 'company_id', 'id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function availableRating(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'available_rating_id', 'id');
    }
}
