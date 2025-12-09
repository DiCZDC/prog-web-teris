<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventUser;
use App\Models\Event;
use App\Models\User;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si hay eventos y usuarios
        $eventsCount = Event::count();
        $usersCount = User::count();
        
        if ($eventsCount === 0 || $usersCount === 0) {
            $this->command->warn('⚠️  No hay eventos o usuarios disponibles. Saltando EventUserSeeder.');
            return;
        }

        // Obtener jueces y eventos
        $jueces = User::role(['juez', 'judge'])->get();
        $eventos = Event::all();

        if ($jueces->isEmpty()) {
            $this->command->warn('⚠️  No hay jueces disponibles para asignar a eventos.');
            $jueces = User::limit(5)->get(); // Usar cualquier usuario
        }

        $relationsCreated = 0;

        // Asignar jueces a eventos de forma aleatoria
        foreach ($eventos as $evento) {
            // Cada evento tendrá entre 1 y 3 jueces
            $numJueces = rand(1, min(3, $jueces->count()));
            $selectedJudges = $jueces->random(min($numJueces, $jueces->count()));

            foreach ($selectedJudges as $juez) {
                // Verificar si la relación ya existe
                $exists = EventUser::where('event_id', $evento->id)
                    ->where('user_id', $juez->id)
                    ->exists();

                if (!$exists) {
                    EventUser::create([
                        'event_id' => $evento->id,
                        'user_id' => $juez->id,
                        'role' => 'Juez',
                    ]);
                    $relationsCreated++;
                }
            }
        }

        // Crear relaciones adicionales con factory si es necesario
        $remainingRelations = 50 - $relationsCreated;
        if ($remainingRelations > 0) {
            try {
                EventUser::factory($remainingRelations)->create();
                $relationsCreated += $remainingRelations;
            } catch (\Exception $e) {
                $this->command->warn("⚠️  No se pudieron crear todas las relaciones con factory: " . $e->getMessage());
            }
        }

        $this->command->info("✅ Relaciones Event-User creadas: {$relationsCreated}");
    }
}
