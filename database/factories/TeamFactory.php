<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(3, true),
            'codigo' => strtoupper(Str::random(6)), // Código único de 6 caracteres
            'descripcion' => $this->faker->sentence(10),
            'icono' => $this->faker->randomElement(['⚡', '🚀', '💡', '🎯', '🔥', '🌟', '🎨', '💻', null]),
            'estado' => $this->faker->boolean(90), // 90% activos
            
            // Relaciones (solo si existen registros)
            'evento_id' => function() {
                $eventId = Event::inRandomOrder()->value('id');
                return $eventId ?? Event::factory();
            },
            'lider_id' => function() {
                $userId = User::inRandomOrder()->value('id');
                return $userId ?? User::factory();
            },
            'disenador_id' => function() {
                return $this->faker->boolean(80) 
                    ? (User::inRandomOrder()->value('id') ?? User::factory())
                    : null;
            },
            'frontprog_id' => function() {
                return $this->faker->boolean(80) 
                    ? (User::inRandomOrder()->value('id') ?? User::factory())
                    : null;
            },
            'backprog_id' => function() {
                return $this->faker->boolean(80) 
                    ? (User::inRandomOrder()->value('id') ?? User::factory())
                    : null;
            },
        ];
    }



/**
     * Estado: Equipo completo (todas las posiciones ocupadas)
     */
    public function complete(): static
    {
        return $this->state(fn (array $attributes) => [
            'disenador_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'frontprog_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'backprog_id' => User::inRandomOrder()->value('id') ?? User::factory(),
        ]);
    }

    /**
     * Estado: Equipo incompleto (algunas posiciones vacías)
     */
    public function incomplete(): static
    {
        return $this->state(fn (array $attributes) => [
            'disenador_id' => $this->faker->boolean(50) ? (User::inRandomOrder()->value('id') ?? User::factory()) : null,
            'frontprog_id' => $this->faker->boolean(50) ? (User::inRandomOrder()->value('id') ?? User::factory()) : null,
            'backprog_id' => null,
        ]);
    }
}
