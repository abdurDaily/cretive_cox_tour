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
        Schema::create('aditional_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('auth_email');
            $table->integer('m_size')->nullable();
            $table->integer('l_size')->nullable();
            $table->integer('xl_size')->nullable();
            $table->integer('xxl_size')->nullable();
            $table->integer('single_room')->nullable();
            $table->integer('couple_room')->nullable();
            $table->longText('opinion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aditional_members');
    }
};
