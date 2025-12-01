<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_category_id',
        'name',
        'short_description',
        'long_description',
        'icon',
        'base_price',
        'base_duration_minutes',
        'is_emergency_available',
        'emergency_surcharge',
        'slug',
        'is_active',
        'sort_order',
        'travel_fee_per_km',
        'requires_site_inspection',
        'satisfaction_survey_template',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'home_featured',
        'og_image',
        'schema_markup',
        'protocol_url',
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
            'service_category_id' => 'integer',
            'base_price' => 'decimal:2',
            'is_emergency_available' => 'boolean',
            'emergency_surcharge' => 'decimal:2',
            'is_active' => 'boolean',
            'travel_fee_per_km' => 'decimal:2',
            'requires_site_inspection' => 'boolean',
            'satisfaction_survey_template' => 'array',
            'schema_markup' => 'array',
        ];
    }

    public function serviceCategory(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function serviceParameters(): HasMany
    {
        return $this->hasMany(ServiceParameter::class);
    }

    public function planScheduledServices(): HasMany
    {
        return $this->hasMany(PlanScheduledService::class);
    }

    public function serviceAreas(): HasMany
    {
        return $this->hasMany(ServiceArea::class);
    }

    public function technicians(): BelongsToMany
    {
        return $this->belongsToMany(Technician::class);
    }
}
