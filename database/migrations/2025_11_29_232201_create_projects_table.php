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
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('url_repositorio')->nullable();
            $table->string('etapa_validacion')->default('Pendiente');
            $table->timestamps();

            // Índices
            $table->index('team_id');
            $table->index('etapa_validacion');
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