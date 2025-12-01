<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('home_id')->nullable()->change();
            $table->decimal('tax_amount', 10, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('home_id')->nullable(false)->change();
            $table->decimal('tax_amount', 10, 2)->nullable(false)->change();
        });
    }
};
