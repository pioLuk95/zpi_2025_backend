<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        DB::table('roles')->insert([
            ['name' => 'internist'],
            ['name' => 'specialist'],
            ['name' => 'rehabilitator'],
            ['name' => 'nurse'],
            ['name' => 'doctor'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
