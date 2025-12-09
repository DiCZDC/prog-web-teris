<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ================= Usuarios Iniciales =================
        $adminUser = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        $normalUser = User::firstOrCreate(
            ['email' => 'normal@example.com'],
            [
                'name' => 'Normal User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        $judgeUser = User::firstOrCreate(
            ['email' => 'judge@example.com'],
            [
                'name' => 'Judge User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Obtener roles existentes
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleJudge = Role::firstOrCreate(['name' => 'judge']);
        $roleUser  = Role::firstOrCreate(['name' => 'user']);
        $roleJuez  = Role::firstOrCreate(['name' => 'juez']);
        $roleParticipante = Role::firstOrCreate(['name' => 'participante']);
        $roleAdministrador = Role::firstOrCreate(['name' => 'administrador']);

        // ================= Asignación de roles =================
        $adminUser->assignRole($roleAdmin);
        $adminUser->syncPermissions(Permission::query()->pluck('name'));

        $normalUser->assignRole($roleUser);
        $judgeUser->assignRole($roleJudge);
        $judgeUser->assignRole($roleJuez);

        // ================= ADMIN TERIS =================
        $mainAdmin = User::firstOrCreate(
            ['email' => 'admin@teris.com'],
            [
                'name' => 'Administrador TERIS',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        $mainAdmin->assignRole($roleAdministrador);
        $mainAdmin->assignRole($roleAdmin);

        // ================= Jueces Adicionales =================
        $jueces = [
            ['name' => 'Dr. Juan Pérez', 'email' => 'juez1@teris.com'],
            ['name' => 'Ing. María González', 'email' => 'juez2@teris.com'],
            ['name' => 'Mtro. Carlos Rodríguez', 'email' => 'juez3@teris.com'],
        ];

        foreach ($jueces as $juezData) {
            $juez = User::firstOrCreate(
                ['email' => $juezData['email']],
                [
                    'name' => $juezData['name'],
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ]
            );

            $juez->assignRole($roleJuez);
            $juez->assignRole($roleJudge);
        }

        // ================= Participantes Fijos =================
        $nombres = [
            'Ana', 'Luis', 'Carmen', 'Pedro', 'Laura',
            'Miguel', 'Sofia', 'Diego', 'Elena', 'Javier',
            'Gabriela', 'Roberto', 'Valentina', 'Fernando', 'Isabella',
            'Andrés', 'Camila', 'Ricardo', 'Daniela', 'Emilio'
        ];

        foreach ($nombres as $index => $nombre) {
            $participante = User::firstOrCreate(
                ['email' => 'participante' . ($index + 1) . '@teris.com'],
                [
                    'name' => $nombre . ' López',
                    'password' => bcrypt('password'),
                    'email_verified_at' => now(),
                ]
            );

            $participante->assignRole($roleParticipante);
            $participante->assignRole($roleUser);
        }

        // ================= Usuarios Factory =================
        $existingCount = User::count();
        if ($existingCount < 50) {
            User::factory(50 - $existingCount)->create();
        }

        // ================= Roles faltantes =================
        User::all()->each(function ($user) use ($roleUser) {
            if (!$user->hasAnyRole(['admin', 'judge', 'user', 'administrador', 'juez', 'participante'])) {
                $user->assignRole($roleUser);
            }
        });

        $this->command->info('Usuarios creados: 2 Admins, 4 Jueces, 20 Participantes + usuarios adicionales!');
    }
}
