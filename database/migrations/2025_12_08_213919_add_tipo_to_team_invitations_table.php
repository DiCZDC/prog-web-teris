<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('team_invitations', function (Blueprint $table) {
            // Agregar columna 'tipo' después de 'user_id'
            $table->enum('tipo', ['invitacion', 'solicitud'])
                  ->default('invitacion')
                  ->after('user_id');
            
            // Agregar índice para búsquedas rápidas
            $table->index(['tipo', 'status']);
        });
    }

    public function down(): void
    {
        Schema::table('team_invitations', function (Blueprint $table) {
            $table->dropIndex(['tipo', 'status']);
            $table->dropColumn('tipo');
        });
    }
};
