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
            'imagen' => $this->faker->imageUrl(),
            'inicio_evento' => $this->faker->dateTime,
            'fin_evento' => $this->faker->dateTime,
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'modalidad' => $this->faker->randomElement(['Presencial', 'Virtual', 'Híbrido']),
            'ubicacion' => $this->faker->city,
            'reglas' => $this->faker->paragraph,
            'premios' => $this->faker->paragraph,
            'popular' => $this->faker->boolean,
        ];
    }
}
