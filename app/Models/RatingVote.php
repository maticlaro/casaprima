<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingVote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating_id',
        'customer_id',
        'is_helpful',
        'appointment_rating_id',
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
            'rating_id' => 'integer',
            'customer_id' => 'integer',
            'is_helpful' => 'boolean',
            'appointment_rating_id' => 'integer',
        ];
    }

    public function appointmentRating(): BelongsTo
    {
        return $this->belongsTo(AppointmentRating::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function rating(): BelongsTo
    {
        return $this->belongsTo(AppointmentRating::class);
    }
}
