<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Str;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ============= EQUIPOS ESPECÍFICOS PARA EVENTOS CON JUECES =============
        
        // Obtener eventos y participantes
        $hackathon = Event::where('nombre', 'LIKE', '%Hackathon TERIS%')->first();
        $diseno = Event::where('nombre', 'LIKE', '%Diseño UX/UI%')->first();
        $participantes = User::role(['participante', 'user'])->get();

        if ($hackathon && $participantes->count() >= 16) {
            // Crear 4 equipos completos para el Hackathon
            $equiposHackathon = [
                [
                    'nombre' => 'Code Warriors',
                    'descripcion' => 'Especialistas en IA y Machine Learning',
                    'icono' => '🛡️',
                ],
                [
                    'nombre' => 'Tech Innovators',
                    'descripcion' => 'Expertos en blockchain y Web3',
                    'icono' => '💡',
                ],
                [
                    'nombre' => 'Digital Creators',
                    'descripcion' => 'Enfoque en UX/UI inmersivo',
                    'icono' => '🎨',
                ],
                [
                    'nombre' => 'Cloud Masters',
                    'descripcion' => 'Arquitectura cloud y microservicios',
                    'icono' => '☁️',
                ],
            ];

            $indexParticipante = 0;
            foreach ($equiposHackathon as $equipoData) {
                $miembros = $participantes->slice($indexParticipante, 4);
                
                if ($miembros->count() >= 4) {
                    Team::firstOrCreate(
                        [
                            'nombre' => $equipoData['nombre'],
                            'evento_id' => $hackathon->id,
                        ],
                        [
                            'codigo' => strtoupper(Str::random(6)),
                            'descripcion' => $equipoData['descripcion'],
                            'icono' => $equipoData['icono'],
                            'estado' => true,
                            'lider_id' => $miembros[0]->id,
                            'disenador_id' => $miembros[1]->id,
                            'frontprog_id' => $miembros[2]->id,
                            'backprog_id' => $miembros[3]->id,
                        ]
                    );
                }
                
                $indexParticipante += 4;
            }
        }

        if ($diseno && $participantes->count() >= 24) {
            // Crear 2 equipos para el evento de Diseño
            $equiposDiseno = [
                [
                    'nombre' => 'Pixel Perfect',
                    'descripcion' => 'Obsesionados con el detalle visual',
                    'icono' => '🖼️',
                ],
                [
                    'nombre' => 'UX Masters',
                    'descripcion' => 'Experiencia de usuario primero',
                    'icono' => '🎯',
                ],
            ];

            foreach ($equiposDiseno as $equipoData) {
                $miembros = $participantes->slice($indexParticipante, 4);
                
                if ($miembros->count() >= 4) {
                    Team::firstOrCreate(
                        [
                            'nombre' => $equipoData['nombre'],
                            'evento_id' => $diseno->id,
                        ],
                        [
                            'codigo' => strtoupper(Str::random(6)),
                            'descripcion' => $equipoData['descripcion'],
                            'icono' => $equipoData['icono'],
                            'estado' => true,
                            'lider_id' => $miembros[0]->id,
                            'disenador_id' => $miembros[1]->id,
                            'frontprog_id' => $miembros[2]->id,
                            'backprog_id' => $miembros[3]->id,
                        ]
                    );
                }
                
                $indexParticipante += 4;
            }
        }

        // ============= EQUIPO INCOMPLETO (EJEMPLO) =============
        if ($hackathon && $participantes->count() >= 26) {
            Team::firstOrCreate(
                [
                    'nombre' => 'Byte Builders',
                    'evento_id' => $hackathon->id,
                ],
                [
                    'codigo' => strtoupper(Str::random(6)),
                    'descripcion' => 'Equipo en formación',
                    'icono' => '🔧',
                    'estado' => true,
                    'lider_id' => $participantes[24]->id,
                    'disenador_id' => $participantes[25]->id,
                    'frontprog_id' => null,
                    'backprog_id' => null,
                ]
            );
        }

        // ============= EQUIPOS FACTORY (RESTO) =============
        $existingCount = Team::count();
        if ($existingCount < 150) {
            Team::factory(150 - $existingCount)->create();
        }

        $this->command->info('✅ Equipos creados: 6 específicos con participantes + Factory teams');
    }
}