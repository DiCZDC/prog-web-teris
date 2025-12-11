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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // Información básica del proyecto
            $table->string('nombre');
            $table->longText('descripcion')->nullable();
            
            // Relación con el equipo (UNIQUE para una sola oportunidad)
            $table->foreignId('team_id')
                  ->constrained('teams')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // URLs del proyecto
            $table->string('url', 500); // URL principal del proyecto
            $table->string('repositorio_url', 500)->nullable(); // También conocido como url_repositorio
            $table->string('demo_url', 500)->nullable();
            $table->string('documentacion_url', 500)->nullable();
            
            // Estado y validación
            $table->boolean('estado')->default(true);
            $table->string('etapa_validacion')->nullable();
            
            // Auditoría
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
            
            // CONSTRAINT ÚNICO: Un equipo solo puede tener un proyecto (UNA SOLA OPORTUNIDAD)
            $table->unique('team_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};