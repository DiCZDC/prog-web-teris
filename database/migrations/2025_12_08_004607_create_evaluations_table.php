<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            
            // Relaciones
            $table->foreignId('judge_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            
            // Puntajes (1-10)
            $table->decimal('score_innovacion', 4, 2);
            $table->decimal('score_funcionalidad', 4, 2);
            $table->decimal('score_diseno', 4, 2);
            $table->decimal('score_presentacion', 4, 2);
            
            // Puntaje total (promedio)
            $table->decimal('total_score', 4, 2);
            
            // Comentarios
            $table->text('comments')->nullable();
            
            $table->timestamps();
            
            // Restricciones
            $table->unique(['judge_id', 'project_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};