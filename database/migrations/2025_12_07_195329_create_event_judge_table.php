<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_judge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('judge_id')->constrained('users')->onDelete('cascade'); // ← CAMBIO AQUÍ
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamps();
            
       
            $table->unique(['event_id', 'judge_id']); // ← CAMBIO AQUÍ
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_judge');
    }
};