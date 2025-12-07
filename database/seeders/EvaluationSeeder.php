<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EvaluationSeeder extends Seeder
{
    public function run(): void
    {
        // ============= CREAR CRITERIOS DE EVALUACIÓN =============
        
        // Obtener eventos específicos
        $hackathon = Event::where('nombre', 'LIKE', '%Hackathon TERIS%')->first();
        $diseno = Event::where('nombre', 'LIKE', '%Diseño UX/UI%')->first();

        // Criterios para Hackathon
        if ($hackathon) {
            $criteriosHackathon = [
                [
                    'name' => 'Innovación',
                    'description' => 'Originalidad y creatividad de la solución propuesta',
                    'max_score' => 10,
                    'weight' => 3,
                    'is_default' => true,
                ],
                [
                    'name' => 'Calidad Técnica',
                    'description' => 'Implementación técnica, código limpio y buenas prácticas',
                    'max_score' => 10,
                    'weight' => 3,
                    'is_default' => true,
                ],
                [
                    'name' => 'Funcionalidad',
                    'description' => 'El proyecto funciona correctamente y cumple los requisitos',
                    'max_score' => 10,
                    'weight' => 2,
                    'is_default' => true,
                ],
                [
                    'name' => 'Presentación',
                    'description' => 'Calidad de la presentación y comunicación del proyecto',
                    'max_score' => 10,
                    'weight' => 1,
                    'is_default' => true,
                ],
                [
                    'name' => 'Escalabilidad',
                    'description' => 'Potencial de crecimiento y escalabilidad de la solución',
                    'max_score' => 10,
                    'weight' => 1,
                    'is_default' => true,
                ],
            ];

            foreach ($criteriosHackathon as $criterio) {
                DB::table('evaluation_criteria')->updateOrInsert(
                    [
                        'event_id' => $hackathon->id,
                        'name' => $criterio['name']
                    ],
                    [
                        'description' => $criterio['description'],
                        'max_score' => $criterio['max_score'],
                        'weight' => $criterio['weight'],
                        'is_default' => $criterio['is_default'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        // Criterios para Diseño Web
        if ($diseno) {
            $criteriosDiseño = [
                [
                    'name' => 'Diseño Visual',
                    'description' => 'Estética, uso de colores, tipografía y composición',
                    'max_score' => 10,
                    'weight' => 3,
                    'is_default' => true,
                ],
                [
                    'name' => 'Usabilidad',
                    'description' => 'Facilidad de uso y navegación intuitiva',
                    'max_score' => 10,
                    'weight' => 3,
                    'is_default' => true,
                ],
                [
                    'name' => 'Responsividad',
                    'description' => 'Adaptación correcta a diferentes dispositivos',
                    'max_score' => 10,
                    'weight' => 2,
                    'is_default' => true,
                ],
                [
                    'name' => 'Accesibilidad',
                    'description' => 'Cumplimiento de estándares WCAG',
                    'max_score' => 10,
                    'weight' => 2,
                    'is_default' => true,
                ],
            ];

            foreach ($criteriosDiseño as $criterio) {
                DB::table('evaluation_criteria')->updateOrInsert(
                    [
                        'event_id' => $diseno->id,
                        'name' => $criterio['name']
                    ],
                    [
                        'description' => $criterio['description'],
                        'max_score' => $criterio['max_score'],
                        'weight' => $criterio['weight'],
                        'is_default' => $criterio['is_default'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        // ============= GENERAR CALIFICACIONES DE EJEMPLO =============
        
        if ($hackathon) {
            // Obtener jueces y equipos del Hackathon
            $juecesHackathon = $hackathon->judges;
            $equiposHackathon = $hackathon->teams()
                ->whereNotNull('lider_id')
                ->whereNotNull('disenador_id')
                ->whereNotNull('frontprog_id')
                ->whereNotNull('backprog_id')
                ->get();
            
            $criteriosHackathon = DB::table('evaluation_criteria')
                ->where('event_id', $hackathon->id)
                ->get();

            // Calificar solo los primeros 2 equipos (ejemplo parcial)
            if ($equiposHackathon->count() >= 2 && $juecesHackathon->count() > 0) {
                $equiposACalificar = $equiposHackathon->take(2);

                foreach ($equiposACalificar as $equipo) {
                    foreach ($juecesHackathon as $juez) {
                        foreach ($criteriosHackathon as $criterio) {
                            // Verificar si ya existe la calificación
                            $exists = DB::table('team_scores')
                                ->where('team_id', $equipo->id)
                                ->where('event_id', $hackathon->id)
                                ->where('user_id', $juez->id)
                                ->where('evaluation_criteria_id', $criterio->id)
                                ->exists();

                            if (!$exists) {
                                // Generar calificación aleatoria pero realista
                                $score = rand(70, 100) / 10; // Entre 7.0 y 10.0
                                
                                DB::table('team_scores')->insert([
                                    'team_id' => $equipo->id,
                                    'event_id' => $hackathon->id,
                                    'user_id' => $juez->id,
                                    'evaluation_criteria_id' => $criterio->id,
                                    'score' => $score,
                                    'comments' => $this->generateComment($score, $criterio->name),
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                            }
                        }
                    }
                }

                $this->command->info('✅ Calificaciones generadas para 2 equipos del Hackathon');
            }
        }

        $this->command->info('✅ Criterios de evaluación creados para eventos con jueces');
    }

    /**
     * Generar comentario según la calificación
     */
    private function generateComment($score, $criterioName): string
    {
        $comentarios = [
            'excelente' => [
                "Excelente trabajo en {$criterioName}. Supera las expectativas.",
                "Destacado desempeño en {$criterioName}. Muy bien ejecutado.",
                "Impresionante nivel en {$criterioName}. Felicitaciones al equipo.",
                "Sobresaliente en {$criterioName}. Gran capacidad técnica demostrada.",
            ],
            'bueno' => [
                "Buen trabajo en {$criterioName}. Cumple con los requisitos.",
                "Desempeño sólido en {$criterioName}. Bien hecho.",
                "Trabajo satisfactorio en {$criterioName}. Continúen así.",
                "Buen nivel en {$criterioName}. Se nota el esfuerzo del equipo.",
            ],
            'regular' => [
                "Trabajo aceptable en {$criterioName}. Hay espacio para mejorar.",
                "Nivel suficiente en {$criterioName}. Pueden mejorarlo.",
                "Cumple lo básico en {$criterioName}. Recomiendo profundizar más.",
                "Nivel promedio en {$criterioName}. Sugiero más dedicación.",
            ],
        ];

        if ($score >= 9) {
            return $comentarios['excelente'][array_rand($comentarios['excelente'])];
        } elseif ($score >= 7.5) {
            return $comentarios['bueno'][array_rand($comentarios['bueno'])];
        } else {
            return $comentarios['regular'][array_rand($comentarios['regular'])];
        }
    }
}