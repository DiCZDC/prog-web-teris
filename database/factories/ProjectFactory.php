<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\Team;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(4, true),
            'descripcion' => $this->faker->paragraph(3),
            'team_id' => function() {
                $teamId = Team::inRandomOrder()->value('id');
                return $teamId ?? Team::factory();
            },
            'url_repositorio' => $this->faker->boolean(70) 
                ? 'https://github.com/' . $this->faker->userName() . '/' . $this->faker->slug(2)
                : null,
            'etapa_validacion' => $this->faker->randomElement([
                'Pendiente',
                'En Revisión',
                'Aprobado',
                'Rechazado',
                'En Desarrollo',
                'Completado',
            ]),
        ];
    }
}