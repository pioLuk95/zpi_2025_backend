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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('staff_id')->constrained('staff');

            $table->dateTime('insert_date')->nullable();
            $table->date('visit_date')->nullable();
            $table->time('visit_hour')->nullable();
            $table->enum('type', ['home', 'clinic']);
            $table->enum('status', ['new', 'accepted', 'rejected', 'canceled', 'completed']);
            $table->text('comment')->nullable();
            $table->enum('staff_role', ['internist', 'specialist', 'rehabilitator','nurse','doctor']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
