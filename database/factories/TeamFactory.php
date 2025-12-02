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
            'nombre' => $this->faker->sentence,  
            'codigo' => strtoupper(Str::random(10)),  // <--- CAMPO OBLIGATORIO
            'descripcion' => $this->faker->paragraph(),  
            'icono' => null,  
            'estado' => true,  

            // Relaciones
            'evento_id'     => Event::inRandomOrder()->value('id'),
            'lider_id'      => User::inRandomOrder()->value('id'),
            'disenador_id'  => User::inRandomOrder()->value('id'),
            'frontprog_id'  => User::inRandomOrder()->value('id'),
            'backprog_id'   => User::inRandomOrder()->value('id'),
        ];
    }
}

