<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;
use Carbon\Carbon;

class EventosSeeder extends Seeder
{
    public function run(): void
    {
        $eventos = [
            [
                'nombre' => 'Campus Party',
                'descripcion' => 'Encuentro internacional de innovación y cultura digital con conferencias, talleres y hackathons.',
                'imagen' => 'eventos/campus-party.jpg',
                'fecha_inicio' => Carbon::create(2025, 7, 23),
                'fecha_finalizacion' => Carbon::create(2025, 7, 27),
                'estado' => 'Activo',
                'modalidad' => 'Presencial',
                'ubicacion' => 'Ciudad de México',
                'detalles_adicionales' => 'Fomenta la networking entre estudiantes, emprendedores y expertos en tecnología.',
                'popular' => true
            ],
            [
                'nombre' => 'AWS re:Invent',
                'descripcion' => 'Evento anual de Amazon Web Services centrado en cloud computing, seguridad e IA.',
                'imagen' => 'eventos/aws-reinvent.jpg',
                'fecha_inicio' => Carbon::create(2025, 12, 1),
                'fecha_finalizacion' => Carbon::create(2025, 12, 5),
                'estado' => 'Activo',
                'modalidad' => 'Presencial',
                'ubicacion' => 'Las Vegas',
                'detalles_adicionales' => 'Incluye keynotes sobre nuevos servicios de AWS y workshops técnicos.',
                'popular' => true
            ],
            [
                'nombre' => 'Web Summit',
                'descripcion' => 'Conferencia global sobre tecnología, startups e innovación digital.',
                'imagen' => 'eventos/web-summit.jpg',
                'fecha_inicio' => Carbon::create(2025, 11, 12),
                'fecha_finalizacion' => Carbon::create(2025, 11, 25),
                'estado' => 'Activo',
                'modalidad' => 'Presencial',
                'ubicacion' => 'Lisboa, Portugal',
                'detalles_adicionales' => 'Reúne a más de 70,000 asistentes de todo el mundo.',
                'popular' => true
            ]
        ];

        foreach ($eventos as $evento) {
            Evento::create($evento);
        }
    }
}