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
        Schema::rename('patients', 'patients_old');

        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('name', 255);
            $table->string('s_name', 255);
            $table->date('date_of_birth');

            $table->timestamps();
        });

        Schema::drop('patients_old');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('patients', 'patients_old');

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('name', 255);
            $table->string('s_name', 255);
            $table->date('date_of_birth');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::drop('patients_old');
    }
};
