<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('imagen');
            $table->date('fecha_inicio');
            $table->date('fecha_finalizacion');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->enum('modalidad', ['Presencial', 'Virtual', 'Híbrido']);
            $table->string('ubicacion')->nullable();
            $table->text('detalles_adicionales')->nullable();
            $table->boolean('popular')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};