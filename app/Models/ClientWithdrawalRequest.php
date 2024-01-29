<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

        'admin_notes',
        'client_notes',
        'bank_transfer_number',
        'reference_code',
        'action_at',
        'action_by_id',

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

    public function actionBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'action_by_id', 'id');
    }

    public function withdrawalRequestStatus(): BelongsTo
    {
        return $this->belongsTo(SystemLookup::class, 'status', 'id');
    }
}
