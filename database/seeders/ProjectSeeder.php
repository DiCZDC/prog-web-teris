<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener equipos que NO tengan proyecto (para respetar la regla de una sola oportunidad)
        $teamsWithoutProjects = Team::whereDoesntHave('proyecto')->get();

        if ($teamsWithoutProjects->isEmpty()) {
            $this->command->warn('⚠️ Todos los equipos ya tienen proyectos asignados.');
            return;
        }

        $this->command->info("📦 Creando proyectos para {$teamsWithoutProjects->count()} equipos...");

        foreach ($teamsWithoutProjects as $team) {
            // Verificar que el equipo tenga un líder
            if (!$team->lider_id) {
                $this->command->warn("⚠️ Equipo {$team->nombre} no tiene líder, saltando...");
                continue;
            }

            Project::create([
                'nombre' => fake()->sentence(rand(3, 6)),
                'descripcion' => fake()->paragraph(rand(3, 5)),
                'team_id' => $team->id,
                'url' => fake()->url(), // URL principal del proyecto
                'repositorio_url' => fake()->randomElement([
                    'https://github.com/' . fake()->userName() . '/' . fake()->slug(2),
                    null // 30% sin repositorio
                ]),
                'demo_url' => fake()->randomElement([
                    fake()->url(),
                    null // 40% sin demo
                ]),
                'documentacion_url' => fake()->randomElement([
                    'https://docs.' . fake()->domainName(),
                    null // 50% sin documentación
                ]),
                'estado' => fake()->randomElement([true, true, true, false]), // 75% activos
                'etapa_validacion' => fake()->randomElement([
                    'pendiente',
                    'en_revision',
                    'aprobado',
                    'rechazado',
                    null
                ]),
                'created_by' => $team->lider_id,
                'updated_by' => $team->lider_id,
            ]);

            $this->command->info("✓ Proyecto creado para equipo: {$team->nombre}");
        }

        $totalProjects = Project::count();
        $this->command->info("✅ Total de proyectos en la base de datos: {$totalProjects}");
    }
}