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

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->foreignId('technician_id')->constrained();
            $table->foreignId('plan_scheduled_service_id')->nullable()->constrained();
            $table->foreignId('home_id')->constrained();
            $table->foreignId('home_asset_id')->nullable()->constrained();
            $table->dateTime('scheduled_start_datetime');
            $table->dateTime('calculated_end_datetime');
            $table->decimal('final_price', 10, 2);
            $table->decimal('tax_amount', 10, 2);
            $table->boolean('is_emergency')->default(false);
            $table->string('status');
            $table->text('notes_for_technician')->nullable();
            $table->text('customer_notes')->nullable();
            $table->text('cancellation_reason')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status');
            $table->boolean('is_rated')->default(false);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
