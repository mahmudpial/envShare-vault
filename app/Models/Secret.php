<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Secret extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'audit_token',
        'payload',
        'password_hash',
        'max_views',
        'view_count',
        'expires_at',
        'viewed_at',
        'notify_email',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'viewed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function isFullyViewed(): bool
    {
        return $this->view_count >= $this->max_views;
    }

    public function getStatusAttribute(): string
    {
        if ($this->isExpired())
            return 'expired';
        if ($this->isFullyViewed())
            return 'destroyed';
        return 'active';
    }
}