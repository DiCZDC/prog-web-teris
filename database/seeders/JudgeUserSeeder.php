<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class JudgeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar que exista el rol 'juez', si no, crearlo
        $judgeRole = Role::firstOrCreate(['name' => 'juez']);

        // Crear usuarios jueces de prueba
        $judges = [
            [
                'name' => 'Dr. Juan Pérez',
                'email' => 'juan.perez@juez.com',
                'password' => 'password123',
            ],
            [
                'name' => 'Dra. María González',
                'email' => 'maria.gonzalez@juez.com',
                'password' => 'password123',
            ],
            [
                'name' => 'Ing. Carlos Ramírez',
                'email' => 'carlos.ramirez@juez.com',
                'password' => 'password123',
            ],
            [
                'name' => 'Lic. Ana Martínez',
                'email' => 'ana.martinez@juez.com',
                'password' => 'password123',
            ],
        ];

        foreach ($judges as $judgeData) {
            // Crear o actualizar el usuario
            $user = User::updateOrCreate(
                ['email' => $judgeData['email']], // Buscar por email
                [
                    'name' => $judgeData['name'],
                    'password' => Hash::make($judgeData['password']),
                ]
            );

            // Asignar el rol de juez
            if (!$user->hasRole('juez')) {
                $user->assignRole('juez');
            }

            $this->command->info("Usuario juez creado: {$user->email}");
        }

        $this->command->info('¡Usuarios jueces creados exitosamente!');
        $this->command->warn('Credenciales de acceso:');
        $this->command->line('Email: juan.perez@juez.com | Password: password123');
        $this->command->line('Email: maria.gonzalez@juez.com | Password: password123');
        $this->command->line('Email: carlos.ramirez@juez.com | Password: password123');
        $this->command->line('Email: ana.martinez@juez.com | Password: password123');
    }
}