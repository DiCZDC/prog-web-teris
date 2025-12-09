<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🚀 Iniciando seeding de la base de datos TERIS...');
        $this->command->newLine();

        // ============= ORDEN CORRECTO DE EJECUCIÓN =============
        // IMPORTANTE: Los seeders deben ejecutarse en este orden específico
        // para respetar las dependencias entre tablas

        $seeders = [
            // 1. PRIMERO: Roles y Permisos (no dependen de nada)
            RolesAndPermissionsSeeder::class,
            
            // 2. Usuarios (dependen de roles)
            UserSeeder::class,
            
            // 3. Eventos (no dependen de usuarios)
            EventSeeder::class,
            
            // 4. Equipos (dependen de usuarios y eventos)
            TeamSeeder::class,
            
            // 5. Proyectos (dependen de equipos)
            ProjectSeeder::class,
<<<<<<< Updated upstream
        ]);
=======
            
            // 6. EventUser - Relación muchos a muchos (depende de eventos y usuarios)
            EventUserSeeder::class,
            
            // 7. ÚLTIMO: Evaluaciones (depende de eventos, equipos y jueces)
            EvaluationSeeder::class,
        ];

        foreach ($seeders as $seeder) {
            $this->call($seeder);
        }

        $this->command->newLine();
        $this->command->info('✅ ¡Base de datos poblada exitosamente!');
        $this->command->newLine();
        
        // Mostrar resumen e información de acceso
        $this->displaySummary();
>>>>>>> Stashed changes
    }

    /**
     * Mostrar resumen y credenciales de acceso
     */
    private function displaySummary(): void
    {
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('📋 CREDENCIALES DE ACCESO');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        
        $this->command->newLine();
        $this->command->info('👑 ADMINISTRADORES:');
        $this->command->table(
            ['Email', 'Password', 'Rol'],
            [
                ['admin@teris.com', 'password', 'administrador + admin'],
                ['test@example.com', 'password', 'admin'],
            ]
        );
        
        $this->command->newLine();
        $this->command->info('⚖️  JUECES (Pueden evaluar equipos):');
        $this->command->table(
            ['Email', 'Password', 'Nombre'],
            [
                ['judge@example.com', 'password', 'Judge User'],
                ['juez1@teris.com', 'password', 'Dr. Juan Pérez'],
                ['juez2@teris.com', 'password', 'Ing. María González'],
                ['juez3@teris.com', 'password', 'Mtro. Carlos Rodríguez'],
            ]
        );
        
        $this->command->newLine();
        $this->command->info('👥 PARTICIPANTES (Pueden crear/unirse a equipos):');
        $this->command->table(
            ['Email', 'Password'],
            [
                ['normal@example.com', 'password'],
                ['participante1@teris.com', 'password'],
                ['participante2@teris.com', 'password'],
                ['...', '...'],
                ['participante20@teris.com', 'password'],
            ]
        );
        
        $this->command->newLine();
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('📊 RESUMEN DE DATOS GENERADOS');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        
        $stats = [
            ['Roles', '6 roles creados (admin, judge, user, administrador, juez, participante)'],
            ['Permisos', '~20 permisos asignados a roles'],
            ['Usuarios', '~70+ usuarios (incluye factory)'],
            ['Eventos', '5 eventos principales + factory'],
            ['Equipos', '7 equipos específicos + hasta 150 con factory'],
            ['Proyectos', '20 proyectos generados'],
            ['EventUser', '50 relaciones evento-usuario'],
            ['Evaluación', 'Criterios + Calificaciones para 2 equipos'],
        ];
        
        $this->command->table(['Categoría', 'Detalle'], $stats);
        
        $this->command->newLine();
        $this->command->info('🎯 EVENTOS CON SISTEMA DE EVALUACIÓN ACTIVO:');
        $this->command->info('   • Hackathon TERIS 2025 (Jueces: todos asignados)');
        $this->command->info('   • Diseño UX/UI Challenge (Jueces: 2 asignados)');
        
        $this->command->newLine();
        $this->command->warn('💡 TIPS ÚTILES:');
        $this->command->warn('   • php artisan migrate:fresh --seed  → Resetear todo');
        $this->command->warn('   • php artisan db:seed               → Solo ejecutar seeders');
        $this->command->warn('   • Los jueces pueden evaluar equipos en sus eventos asignados');
        $this->command->warn('   • Los participantes pueden crear equipos y unirse a eventos');
        
        $this->command->newLine();
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    }
}