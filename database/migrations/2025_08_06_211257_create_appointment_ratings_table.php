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

        Schema::create('appointment_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained();
            $table->integer('work_quality_rating');
            $table->integer('punctuality_rating');
            $table->integer('communication_rating');
            $table->integer('cleanliness_rating');
            $table->integer('value_rating');
            $table->integer('overall_rating');
            $table->text('public_review')->nullable();
            $table->text('private_feedback')->nullable();
            $table->boolean('is_public')->default(true);
            $table->integer('helpful_votes_count')->default(0);
            $table->timestamp('rating_reminder_sent_at')->nullable();
            $table->json('custom_responses')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_ratings');
    }
};
