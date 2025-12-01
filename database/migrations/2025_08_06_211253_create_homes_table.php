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

        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('name');
            $table->text('address');
            $table->string('region');
            $table->string('comuna');
            $table->string('postal_code')->nullable();
            $table->integer('square_meters')->nullable();
            $table->string('condominium_name')->nullable();
            $table->json('geo_location')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->text('access_instructions')->nullable();
            $table->text('security_instructions')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
