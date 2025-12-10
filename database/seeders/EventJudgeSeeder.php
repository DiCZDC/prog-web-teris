<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventJudgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar tabla pivot primero (opcional)
        DB::table('event_judge')->truncate();

        // Obtener todos los usuarios con rol de juez
        $jueces = User::role('judge')->get();

        // Obtener todos los eventos
        $eventos = Event::all();

        if ($jueces->isEmpty()) {
            $this->command->warn('⚠️  No hay usuarios con rol "juez". Creando uno...');
            
            // Crear un usuario juez de prueba
            $juez = User::create([
                'name' => 'Juan Pérez',
                'email' => 'juez@teris.com',
                'password' => bcrypt('password'),
            ]);
            
            $juez->assignRole('judge');
            $jueces = collect([$juez]);
        }

        if ($eventos->isEmpty()) {
            $this->command->warn('⚠️  No hay eventos en la base de datos.');
            return;
        }

        // Asignar cada juez a todos los eventos (puedes personalizar esto)
        foreach ($jueces as $juez) {
            foreach ($eventos as $evento) {
                // Asignar el juez al evento
                $evento->jueces()->attach($juez->id, [
                    'assigned_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $this->command->info("✅ Juez '{$juez->name}' asignado al evento '{$evento->nombre}'");
            }
        }

        $this->command->info("
✨ Asignación completada:");
        $this->command->info("   - {$jueces->count()} jueces");
        $this->command->info("   - {$eventos->count()} eventos");
        $this->command->info("   - " . ($jueces->count() * $eventos->count()) . " asignaciones totales");
    }
}