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

        Schema::create('service_parameter_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_parameter_id')->constrained();
            $table->string('option_value');
            $table->decimal('price_adjustment', 10, 2)->default(0);
            $table->integer('duration_minutes_adjustment')->default(0);
            $table->string('measurement_unit')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_parameter_options');
    }
};
