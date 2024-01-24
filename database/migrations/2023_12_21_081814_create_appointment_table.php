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
        // patient_name,patient_email,patient_subject, patient_appointment_time, patient_appointment_date, patient_description
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name')->nullable();
            $table->string('patient_email')->nullable();
            $table->string('patient_subject')->nullable();
            $table->date('patient_appointment_date')->nullable();
            $table->time('patient_appointment_time')->nullable();
            $table->text('patient_description')->nullable();
            $table->string('code')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
