<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppointmentRating extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_id',
        'work_quality_rating',
        'punctuality_rating',
        'communication_rating',
        'cleanliness_rating',
        'value_rating',
        'overall_rating',
        'public_review',
        'private_feedback',
        'is_public',
        'helpful_votes_count',
        'rating_reminder_sent_at',
        'custom_responses',
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
            'is_public' => 'boolean',
            'rating_reminder_sent_at' => 'timestamp',
            'custom_responses' => 'array',
        ];
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function ratingVotes(): HasMany
    {
        return $this->hasMany(RatingVote::class);
    }
}
