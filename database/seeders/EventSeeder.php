<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $eventos = [
            [
                'nombre' => 'Campus Party',
                'descripcion' => 'Encuentro internacional de innovación y cultura digital con conferencias, talleres y hackathons.',
                'imagen' => 'eventos/campus-party.jpg',
                'inicio_evento' => '2025-07-23',
                'fin_evento' => '2025-07-27',
                'estado' => 'Activo',
                'modalidad' => 'Presencial',
                'ubicacion' => 'Ciudad de México',
                'reglas' => 'Fomenta la networking entre estudiantes, emprendedores y expertos en tecnología.',
                'premios' => 'El premio consiste en una serie de gadgets tecnológicos.',
                'popular' => true
            ],
            [
                'nombre' => 'AWS re:Invent',
                'descripcion' => 'Evento anual de Amazon Web Services centrado en cloud computing, seguridad e IA.',
                'imagen' => 'https://assets.aboutamazon.com/dims4/default/aeb9629/2147483647/strip/true/crop/2548x1434+2+0/resize/2640x1486!/quality/90/?url=https%3A%2F%2Famazon-blogs-brightspot.s3.amazonaws.com%2F43%2F54%2F2a64c627400f9b8857a2bf8881a4%2Fabout-amazon-feature-hero-001-amazon-amazon-dynamo-5.jpg',
                'inicio_evento' => '2025-12-01',
                'fin_evento' => '2025-12-05',
                'estado' => 'Activo',
                'modalidad' => 'Presencial',
                'ubicacion' => 'Las Vegas',
                'reglas' => 'Incluye keynotes sobre nuevos servicios de AWS y workshops técnicos.',
                'premios' => 'Se otorgan premios a las mejores soluciones desarrolladas durante el evento.',
                'popular' => true
            ],
            [
                'nombre' => 'Web Summit',
                'descripcion' => 'Conferencia global sobre tecnología, startups e innovación digital.',
                'imagen' => 'eventos/web-summit.jpg',
                'inicio_evento' => '2025-11-12',
                'fin_evento' => '2025-11-25',
                'estado' => 'Activo',
                'modalidad' => 'Presencial',
                'ubicacion' => 'Lisboa, Portugal',
                'reglas' => 'Reúne a más de 70,000 asistentes de todo el mundo.',
                'premios' => 'Premios para las startups más innovadoras.',
                'popular' => true
            ]
        ];

        foreach ($eventos as $evento) {
            Event::create($evento);
        }
        Event::factory(10)->create();
    }
}
