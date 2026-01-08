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
            $table->dropForeign(['staff_id']);

            $table->foreignId('staff_id')
                ->nullable()
                ->change();

            $table->foreign('staff_id')
                ->references('id')
                ->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['staff_id']);

            $table->foreignId('staff_id')
                ->nullable(false)
                ->change();

            $table->foreign('staff_id')
                ->references('id')
                ->on('staff');
        });
    }
};
