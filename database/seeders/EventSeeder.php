<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $eventos = [
            [
                'nombre' => 'Hackathon 2024',
                'descripcion' => 'Competencia de desarrollo de software de 48 horas',
                'imagen' => 'https://images.pexels.com/photos/113850/pexels-photo-113850.jpeg',
                'inicio_evento' => Carbon::now()->addDays(30),
                'fin_evento' => Carbon::now()->addDays(32),
                'estado' => 'Activo',
                'modalidad' => 'Híbrido',
                'ubicacion' => 'Centro de Convenciones, Ciudad',
                'reglas' => 'Equipos de 4 personas. Código original. Uso de cualquier tecnología.',
                'premios' => '1er lugar: $5000, 2do lugar: $3000, 3er lugar: $1000',
                'popular' => true
            ],
            [
                'nombre' => 'Game Jam 2024',
                'descripcion' => 'Crea un videojuego en 72 horas',
                'imagen' => 'https://images.pexels.com/photos/113850/pexels-photo-113850.jpeg',
                'inicio_evento' => Carbon::now()->addDays(45),
                'fin_evento' => Carbon::now()->addDays(48),
                'estado' => 'Activo',
                'modalidad' => 'Virtual',
                'ubicacion' => null,
                'reglas' => 'Tema revelado al inicio. Cualquier motor de juego permitido.',
                'premios' => 'Premios en efectivo y licencias de software',
                'popular' => true
            ],
            [
                'nombre' => 'Web Dev Challenge',
                'descripcion' => 'Desarrolla la mejor aplicación web',
                'imagen' => 'https://images.pexels.com/photos/113850/pexels-photo-113850.jpeg',
                'inicio_evento' => Carbon::now()->addDays(15),
                'fin_evento' => Carbon::now()->addDays(17),
                'estado' => 'Activo',
                'modalidad' => 'Presencial',
                'ubicacion' => 'Universidad Tecnológica',
                'reglas' => 'Stack libre. Presentación obligatoria. Deploy en producción.',
                'premios' => 'Tablets y cursos online',
                'popular' => false
            ]
        ];

        foreach ($eventos as $evento) {
            Event::create($evento);
        }
    }
}