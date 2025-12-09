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
        // Tabla para almacenar los ganadores de cada evento
        Schema::create('event_winners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->enum('position', ['1', '2', '3']); // 1er, 2do, 3er lugar
            $table->decimal('final_score', 5, 2); // Puntaje final (0.00 a 999.99)
            $table->text('recognition')->nullable(); // Reconocimiento especial (opcional)
            $table->timestamps();
            
            // Un equipo solo puede tener UNA posición por evento
            $table->unique(['event_id', 'team_id']);
            
            // Una posición solo puede ser asignada a UN equipo por evento
            $table->unique(['event_id', 'position']);
        });
        
        // Agregar campos a la tabla events para controlar publicación
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('winners_published')->default(false)->after('estado');
            $table->timestamp('winners_announced_at')->nullable()->after('winners_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar campos agregados a events
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['winners_published', 'winners_announced_at']);
        });
        
        // Eliminar tabla de ganadores
        Schema::dropIfExists('event_winners');
    }
};