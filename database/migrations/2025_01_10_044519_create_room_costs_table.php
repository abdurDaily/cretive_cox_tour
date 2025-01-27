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
        Schema::create('room_costs', function (Blueprint $table) {
            $table->id();
            $table->integer('single_room_cost')->nullable();
            $table->integer('couple_room_cost')->nullable();
            $table->integer('t_shirt_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_costs');
    }
};
