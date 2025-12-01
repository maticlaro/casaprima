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

        Schema::create('referral_rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_id')->constrained();
            $table->foreignId('beneficiary_id')->constrained('customers');
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending');
            $table->foreignId('appointment_id')->nullable()->constrained();
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('customer_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_rewards');
    }
};
