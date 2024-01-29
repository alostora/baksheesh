<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UpdateProfileRequest extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [

        'client_id',

        'update_profile_request',

        'refuse_reasone',

        'admin_notes',

        'client_notes',

        'action_at',

        'status',

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
