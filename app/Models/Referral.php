<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Referral extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referrer_id',
        'referred_id',
        'code',
        'status',
        'discount_amount',
        'discount_type',
        'expires_at',
        'used_at',
        'customer_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'referrer_id' => 'integer',
            'referred_id' => 'integer',
            'discount_amount' => 'decimal:2',
            'expires_at' => 'timestamp',
            'used_at' => 'timestamp',
            'customer_id' => 'integer',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function referred(): BelongsTo
    {
        return $this->belongsTo(Referred::class);
    }

    public function referralRewards(): HasMany
    {
        return $this->hasMany(ReferralReward::class);
    }
}
