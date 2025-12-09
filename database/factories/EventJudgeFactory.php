<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
<<<<<<< Updated upstream:database/factories/EventJudgeFactory.php

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventJudgeFactory extends Factory
=======
use App\Models\EventUser;
use App\Models\Event;
use App\Models\User;

class EventUserFactory extends Factory
>>>>>>> Stashed changes:database/factories/EventUserFactory.php
{
    protected $model = EventUser::class;

    public function definition(): array
    {
        return [
<<<<<<< Updated upstream:database/factories/EventJudgeFactory.php
            //
=======
            'event_id' => function() {
                $eventId = Event::inRandomOrder()->value('id');
                return $eventId ?? Event::factory();
            },
            'user_id' => function() {
                // Priorizar usuarios con rol de juez
                $judgeId = User::role(['juez', 'judge'])->inRandomOrder()->value('id');
                if ($judgeId) {
                    return $judgeId;
                }
                // Si no hay jueces, usar cualquier usuario
                $userId = User::inRandomOrder()->value('id');
                return $userId ?? User::factory();
            },
            'role' => $this->faker->randomElement(['Juez', 'Organizador']),
>>>>>>> Stashed changes:database/factories/EventUserFactory.php
        ];
    }

    /**
     * Estado: Crear relación con rol de Juez
     */
    public function judge(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'Juez',
            'user_id' => function() {
                $judgeId = User::role(['juez', 'judge'])->inRandomOrder()->value('id');
                return $judgeId ?? User::factory();
            },
        ]);
    }

    /**
     * Estado: Crear relación con rol de Organizador
     */
    public function organizer(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'Organizador',
        ]);
    }
}