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
        // sugar_level, pulse_rate, blood_pressure_top_value, blood_pressure_bottom_value
        Schema::create('health_metrics', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('sugar_level')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('blood_pressure_top_value')->nullable();
            $table->string('blood_pressure_bottom_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_metrics');
    }
};
