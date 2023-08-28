<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientWithdrawalRequest extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [

        'client_id',
        'amount',
        'discount_percentage',
        'status',
        'refuse_reasone',
        'notes',
        'action_by_id',

    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function acceptedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'action_by_id', 'id');
    }
    
    public function withdrawalRequestStatus(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'status', 'id');
    }
}
