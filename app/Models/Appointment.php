<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'service_id',
        'technician_id',
        'plan_scheduled_service_id',
        'home_id',
        'home_asset_id',
        'scheduled_start_datetime',
        'calculated_end_datetime',
        'final_price',
        'tax_amount',
        'is_emergency',
        'status',
        'notes_for_technician',
        'customer_notes',
        'cancellation_reason',
        'payment_method',
        'payment_status',
        'is_rated',
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
            'customer_id' => 'integer',
            'service_id' => 'integer',
            'technician_id' => 'integer',
            'plan_scheduled_service_id' => 'integer',
            'home_id' => 'integer',
            'home_asset_id' => 'integer',
            'scheduled_start_datetime' => 'datetime',
            'calculated_end_datetime' => 'datetime',
            'final_price' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'is_emergency' => 'boolean',
            'is_rated' => 'boolean',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(Technician::class);
    }

    public function planScheduledService(): BelongsTo
    {
        return $this->belongsTo(PlanScheduledService::class);
    }

    public function home(): BelongsTo
    {
        return $this->belongsTo(Home::class);
    }

    public function homeAsset(): BelongsTo
    {
        return $this->belongsTo(HomeAsset::class);
    }

    public function appointmentLogs(): HasMany
    {
        return $this->hasMany(AppointmentLog::class);
    }

    public function appointmentRating(): HasOne
    {
        return $this->hasOne(AppointmentRating::class);
    }

    public function serviceParameterOptions(): BelongsToMany
    {
        return $this->belongsToMany(ServiceParameterOption::class);
    }
}
