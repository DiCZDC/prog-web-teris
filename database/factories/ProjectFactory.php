<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\Team;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'team_id' => Team::inRandomOrder()->value('id'),
            'repositorio_url' => $this->faker->url,
            'demo_url' => $this->faker->url,
            'documentacion_url' => $this->faker->url,
            'etapa_validacion' => $this->faker->word,
        ];
    }
}
