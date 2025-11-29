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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->foreignId('id_lider')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_disenador')->constrained('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_frontprog')->constrained('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_back_prog')->constrained('events')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
