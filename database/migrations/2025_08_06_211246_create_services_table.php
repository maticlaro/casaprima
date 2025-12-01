<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->constrained();
            $table->string('name')->unique();
            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->text('icon')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->integer('base_duration_minutes');
            $table->boolean('is_emergency_available')->default(false);
            $table->decimal('emergency_surcharge', 10, 2)->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->decimal('travel_fee_per_km', 10, 2)->nullable();
            $table->boolean('requires_site_inspection')->default(false);
            $table->json('satisfaction_survey_template')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->string('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->json('schema_markup')->nullable();
            $table->string('protocol_url')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
