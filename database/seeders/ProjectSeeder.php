<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Team;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si hay equipos existentes
      $teamsCount = Team::count();
        
        if ($teamsCount === 0) {
            $this->command->warn('⚠️  No hay equipos disponibles. Saltando ProjectSeeder.');
            return;
        }

        // Obtener equipos completos
        $completeTeams = Team::whereNotNull('lider_id')
            ->whereNotNull('disenador_id')
            ->whereNotNull('frontprog_id')
            ->whereNotNull('backprog_id')
            ->get();

        if ($completeTeams->isEmpty()) {
            $this->command->warn('⚠️  No hay equipos completos. Creando proyectos para equipos incompletos...');
            $completeTeams = Team::limit(20)->get();
        }

        // Crear proyectos solo para equipos que aún no tengan proyecto
        $projectsCreated = 0;
        
        foreach ($completeTeams->take(20) as $team) {
            // Verificar si el equipo ya tiene un proyecto
            if (!Project::where('team_id', $team->id)->exists()) {
                Project::create([
                    'nombre' => 'Proyecto ' . $team->nombre,
                    'descripcion' => 'Proyecto desarrollado por el equipo ' . $team->nombre,
                    'team_id' => $team->id,
                    'url_repositorio' => 'https://github.com/teris/' . strtolower(str_replace(' ', '-', $team->nombre)),
                    'etapa_validacion' => fake()->randomElement(['Pendiente', 'En Revisión', 'Aprobado', 'En Desarrollo']),
                ]);
                $projectsCreated++;
            }
        }

        // Si necesitamos más proyectos, crear con factory
        $remainingProjects = 20 - $projectsCreated;
        if ($remainingProjects > 0 && Team::count() > 0) {
            Project::factory($remainingProjects)->create();
            $projectsCreated += $remainingProjects;
        }

        $this->command->info("✅ Proyectos creados: {$projectsCreated}");
    }
}

