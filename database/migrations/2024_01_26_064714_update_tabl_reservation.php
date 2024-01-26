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
        Schema::table('reservations', function (Blueprint $table) {
            $table->tinyInteger('room_type', unsigned: true)->after('room_id');
            $table->double('min_price', unsigned: true)->after('room_type');
            $table->double('max_price', unsigned: true)->after('min_price');
            $table->bigInteger('room_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['room_type', 'min_price', 'max_price']);
            $table->bigInteger('room_id')->change();
        });
    }
};
