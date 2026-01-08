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
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('staff_role');

            $table->foreignId('staff_role_id')
                ->nullable()
                ->constrained('roles')
                ->onDelete('set null')
                ->after('staff_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['staff_role_id']);
            $table->dropColumn('staff_role_id');

            $table->enum('staff_role', [
                'internist',
                'specialist',
                'rehabilitator',
                'nurse',
                'doctor',
            ]);
        });
    }
};
