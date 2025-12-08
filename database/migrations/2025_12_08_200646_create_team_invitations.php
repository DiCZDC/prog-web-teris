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
        Schema::create('team_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('invited_by')->constrained('users')->onDelete('cascade'); // Quien invita (líder)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Usuario invitado
            $table->enum('rol', ['DISEÑADOR', 'PROGRAMADOR FRONT', 'PROGRAMADOR BACK']);
            $table->enum('status', ['pendiente', 'aceptada', 'rechazada'])->default('pendiente');
            $table->text('mensaje')->nullable(); // Mensaje opcional del líder
            $table->timestamp('responded_at')->nullable(); // Cuando respondió
            $table->timestamps();
            
            // Índices para búsquedas rápidas
            $table->index(['user_id', 'status']);
            $table->index(['team_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_invitations');
    }
};