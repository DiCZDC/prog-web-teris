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
            'inicio_evento' => $this->faker->dateTime,
            'fin_evento' => $this->faker->dateTime,
            'reglas' => $this->faker->paragraph,
            'premios' => $this->faker->paragraph,
            'estado' => $this->faker->randomElement(['Sin Enviar', 'Pendiente de Evaluación', 'Evaluado', 'Aprobado', 'Rechazado']),
        ];
    }
}
