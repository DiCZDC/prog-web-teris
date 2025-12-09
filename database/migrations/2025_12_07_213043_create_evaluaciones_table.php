<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juez_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('equipo_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('evento_id')->constrained('events')->onDelete('cascade');
            
            // Criterios de evaluación
            $table->decimal('criterio_1', 5, 2); // Innovación y Originalidad
            $table->decimal('criterio_2', 5, 2); // Funcionalidad y Completitud
            $table->decimal('criterio_3', 5, 2); // Diseño y Experiencia de Usuario
            $table->decimal('criterio_4', 5, 2); // Calidad del Código
            $table->decimal('criterio_5', 5, 2); // Presentación y Defensa
            
            // Puntajes
            $table->decimal('promedio', 5, 2);
            $table->text('comentarios')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->text('fortalezas')->nullable();
            $table->text('debilidades')->nullable();
            
            // Estado
            $table->enum('estado', ['pendiente', 'evaluado', 'revisado', 'aprobado', 'rechazado'])->default('pendiente');
            
            $table->timestamps();
            
            // Índices
            $table->index(['juez_id', 'equipo_id']);
            $table->index('evento_id');
            $table->unique(['juez_id', 'equipo_id', 'evento_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
};