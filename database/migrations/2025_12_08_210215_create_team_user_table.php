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
        Schema::create('team_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('rol', ['LIDER', 'DISEÑADOR', 'PROGRAMADOR FRONT', 'PROGRAMADOR BACK']);
            $table->timestamps();
            
            // Un usuario puede tener un rol por equipo
            $table->unique(['team_id', 'user_id']);
            
            // Índices
            $table->index('user_id');
            $table->index('team_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_user');
    }
};
