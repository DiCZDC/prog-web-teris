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
        Schema::create('proyects', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            //Equipo FK
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade')->onUpdate('cascade');
            
            //Evento FK
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade')->onUpdate('cascade');

            $table->string('url_repositorio')-> nullable();

            $table->string('etapa_validacion')-> nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyects');
    }
};
