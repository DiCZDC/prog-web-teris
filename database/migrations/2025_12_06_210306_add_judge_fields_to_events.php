<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        // 2. SEGUNDO: Tabla para criterios de evaluación (depende de events)
        Schema::create('evaluation_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('max_score')->default(10);
            $table->integer('weight')->default(1);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            
            $table->index('event_id');
        });

        // 3. TERCERO: Tabla para las calificaciones (depende de evaluation_criteria)
        Schema::create('team_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('evaluation_criteria_id')->constrained('evaluation_criteria')->onDelete('cascade'); // ⭐ AHORA SÍ EXISTE
            $table->decimal('score', 5, 2);
            $table->text('comments')->nullable();
            $table->timestamps();
            
            // Índices
            $table->index(['team_id', 'user_id', 'evaluation_criteria_id'], 'team_judge_criteria_idx');
            $table->index(['event_id', 'team_id']);
            
            // Constraint único: un juez solo puede calificar un criterio una vez por equipo
            $table->unique(['team_id', 'user_id', 'evaluation_criteria_id'], 'unique_team_judge_criteria');
        });

    }

    public function down(): void
    {
        // Eliminar en orden inverso (de dependiente a independiente)
        Schema::dropIfExists('team_scores');
        Schema::dropIfExists('evaluation_criteria');
        Schema::dropIfExists('event_judge');
        
        if (Schema::hasColumn('events', 'popular')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('popular');
            });
        }
    }
};