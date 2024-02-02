<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAvailableRating extends Model
{
    use HasFactory, HasUuids/* , SoftDeletes */;

    protected $fillable = [

        'client_id',

        'name',

        'name_ar',

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
        return $this->belongsTo(User::class, 'client_id', 'id')
            ->where('stopped_at', null);
    }
}
