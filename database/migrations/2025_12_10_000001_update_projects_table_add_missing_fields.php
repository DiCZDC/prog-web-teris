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
        Schema::table('projects', function (Blueprint $table) {
            // Renombrar columna url_repositorio a repositorio_url si existe
            if (Schema::hasColumn('projects', 'url_repositorio')) {
                $table->renameColumn('url_repositorio', 'repositorio_url');
            }

            // Agregar campos faltantes si no existen
            if (!Schema::hasColumn('projects', 'estado')) {
                $table->boolean('estado')->default(true)->after('descripcion');
            }

            if (!Schema::hasColumn('projects', 'demo_url')) {
                $table->string('demo_url', 500)->nullable()->after('repositorio_url');
            }

            if (!Schema::hasColumn('projects', 'documentacion_url')) {
                $table->string('documentacion_url', 500)->nullable()->after('demo_url');
            }

            if (!Schema::hasColumn('projects', 'created_by')) {
                $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            }

            if (!Schema::hasColumn('projects', 'updated_by')) {
                $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            }

            // Modificar longitud de repositorio_url
            $table->string('repositorio_url', 500)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Renombrar de vuelta
            if (Schema::hasColumn('projects', 'repositorio_url')) {
                $table->renameColumn('repositorio_url', 'url_repositorio');
            }

            // Eliminar columnas agregadas
            $table->dropColumn(['estado', 'demo_url', 'documentacion_url', 'created_by', 'updated_by']);
        });
    }
};
