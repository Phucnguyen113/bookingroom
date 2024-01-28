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
            $table->string('phone')->nullable()->change();
            $table->tinyInteger('room_type')->nullable()->change();
            $table->double('min_price')->nullable()->change();
            $table->double('max_price')->nullable()->change();
            $table->integer('bedroom')->nullable()->change();
            $table->integer('bathroom')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('phone')->change();
            $table->tinyInteger('room_type')->change();
            $table->double('min_price')->change();
            $table->double('max_price')->change();
            $table->integer('bedroom')->change();
            $table->integer('bathroom')->change();
        });
    }
};
