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

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->nullable()->constrained();
            $table->foreignId('maintenance_plan_id')->nullable()->constrained();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded']);
            $table->enum('payment_method', ['webpay', 'webpay_plus', 'webpay_oneclick', 'khipu', 'mach', 'mercadopago', 'bank_transfer', 'cash', 'check', 'debit_card', 'credit_card', 'pat']);
            $table->enum('payment_platform', ['transbank', 'khipu', 'mercadopago', 'manual'])->nullable();
            $table->string('webpay_token')->nullable();
            $table->string('webpay_session_id')->nullable();
            $table->string('webpay_transaction_id')->nullable();
            $table->string('webpay_card_type')->nullable();
            $table->string('webpay_card_number')->nullable();
            $table->string('webpay_auth_code')->nullable();
            $table->string('webpay_response_code')->nullable();
            $table->string('khipu_payment_id')->nullable();
            $table->string('khipu_transfer_id')->nullable();
            $table->string('khipu_bank_id')->nullable();
            $table->string('khipu_bank_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_type')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->date('bank_transfer_date')->nullable();
            $table->string('bank_transfer_number')->nullable();
            $table->string('pat_subscription_id')->nullable();
            $table->string('pat_authorization_code')->nullable();
            $table->string('pat_last_four')->nullable();
            $table->string('mach_transaction_id')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_number')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('business_name')->nullable();
            $table->string('business_activity')->nullable();
            $table->string('business_address')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->text('refund_reason')->nullable();
            $table->string('internal_reference')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
