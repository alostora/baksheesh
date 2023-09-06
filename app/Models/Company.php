<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [

        'name',

        'client_id',

        'stopped_at',

    ];

    protected $casts = [

        'stopped_at' => 'datetime'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }

    public function cash(): HasMany
    {
        return $this->hasMany(CompanyCash::class, 'company_id', 'id');
    }
}
