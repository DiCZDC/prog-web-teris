<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;
use App\Models\Event;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=> $this->faker->sentence,
            'evento_id' => Event::inRandomOrder()->value('id') ,
            'lider_id' => User::inRandomOrder()->value('id') ,
            'disenador_id' => User::inRandomOrder()->value('id') ,
            'frontprog_id' => User::inRandomOrder()->value('id') ,
            'backprog_id' => User::inRandomOrder()->value('id') ,
        ];
    }
}
