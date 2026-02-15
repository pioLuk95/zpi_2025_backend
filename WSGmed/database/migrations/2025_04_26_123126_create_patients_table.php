<?php

use App\Models\Patient;
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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('name', 255);
            $table->string('s_name', 255);
            $table->enum('status', [Patient::STATUS_NEW, Patient::STATUS_UNDER_TREATMENT, Patient::STATUS_DISCHARGED, Patient::STATUS_DIED])->default(Patient::STATUS_NEW);
            $table->date('date_of_birth');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
