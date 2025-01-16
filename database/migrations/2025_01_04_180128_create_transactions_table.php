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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('auth_user');
            $table->foreignId('additional_cost_user')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->enum('transaction_category', ['food', 'transportation', 'personal cost', 'office', 'others']);
            $table->longText('transaction_description')->nullable();
            $table->integer('add_amount')->nullable();
            $table->integer('cost_amount')->nullable();
            // $table->integer('additional_person')->nullable();
            // $table->integer('additional_person_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
