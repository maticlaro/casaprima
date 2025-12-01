<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReferralReward extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'referral_id',
        'beneficiary_id',
        'amount',
        'status',
        'appointment_id',
        'paid_at',
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
            'referral_id' => 'integer',
            'beneficiary_id' => 'integer',
            'amount' => 'decimal:2',
            'appointment_id' => 'integer',
            'paid_at' => 'timestamp',
            'customer_id' => 'integer',
        ];
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Referral::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
