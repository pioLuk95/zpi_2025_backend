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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');

            $table->dateTime('insert_date')->nullable();
            $table->float('temperature')->nullable();
            $table->float('pulse')->nullable();
            $table->float('weight')->nullable();
            $table->enum('mood', ['very_bad', 'bad', 'good', 'very_good'])->nullable();
            $table->integer('pain_level')->nullable();
            $table->integer('oxygen_saturation')->nullable();
            $table->integer('systolic_pressure')->nullable();
            $table->integer('diastolic_pressure')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
