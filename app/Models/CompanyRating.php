<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyRating extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [

        'payer_name',

        'payer_email',

        'payer_phone',

        'guest_key',

        'client_id',

        'company_id',

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
    
    public function availableRating(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'rating_id', 'id');
    }
}