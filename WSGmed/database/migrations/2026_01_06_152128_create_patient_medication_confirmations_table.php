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
        Schema::create('patient_medication_confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_medication_id')->constrained('patient_medications');

            $table->date('planned_date');
            $table->dateTime('confirmation_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_medication_confirmations');
    }
};
