<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_id',
        'maintenance_plan_id',
        'amount',
        'status',
        'payment_method',
        'payment_platform',
        'webpay_token',
        'webpay_session_id',
        'webpay_transaction_id',
        'webpay_card_type',
        'webpay_card_number',
        'webpay_auth_code',
        'webpay_response_code',
        'khipu_payment_id',
        'khipu_transfer_id',
        'khipu_bank_id',
        'khipu_bank_name',
        'bank_name',
        'bank_account_type',
        'bank_account_number',
        'bank_transfer_date',
        'bank_transfer_number',
        'pat_subscription_id',
        'pat_authorization_code',
        'pat_last_four',
        'mach_transaction_id',
        'document_type',
        'document_number',
        'tax_id',
        'business_name',
        'business_activity',
        'business_address',
        'notes',
        'paid_at',
        'refunded_at',
        'refund_reason',
        'internal_reference',
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
            'appointment_id' => 'integer',
            'maintenance_plan_id' => 'integer',
            'amount' => 'decimal:2',
            'bank_transfer_date' => 'date',
            'paid_at' => 'timestamp',
            'refunded_at' => 'timestamp',
        ];
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function maintenancePlan(): BelongsTo
    {
        return $this->belongsTo(MaintenancePlan::class);
    }
}
