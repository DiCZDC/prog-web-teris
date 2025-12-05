<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
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
            'imagen' => 'https://picsum.photos/1600/1200?random' . $this->faker->numberBetween(1, 5000),

            'inicio_evento' => $this->faker->dateTime,
            'fin_evento' => $this->faker->dateTime,
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'modalidad' => $this->faker->randomElement(['Presencial', 'Virtual', 'Híbrido']),
            'ubicacion' => $this->faker->randomElement(['Presencial', 'Híbrido']) === $this->faker->randomElement(['Presencial', 'Híbrido']) 
                ? $this->faker->city 
                : null,
            'reglas' => $this->faker->paragraph,
            'premios' => $this->faker->paragraph,
            'popular' => $this->faker->boolean,
        ];
    }
}
