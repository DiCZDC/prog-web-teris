<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ============= CREAR PERMISOS =============
        $permissions = [
            // Gestión de eventos
            'create events',
            'edit events',
            'delete events',
            'view events',
            'assign judges',
            
            // Gestión de equipos
            'create teams',
            'edit teams',
            'delete teams',
            'view teams',
            'join team',
            
            // Gestión de usuarios
            'manage users',
            'assign roles',
            'view users',
            
            // Evaluación
            'evaluate teams',
            'view evaluations',
            'edit own evaluations',
            'view results',
            
            // Criterios de evaluación
            'manage criteria',
            
            // Dashboard
            'view admin dashboard',
            'view judge dashboard',
            'view participant dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ============= CREAR O ACTUALIZAR ROLES =============
        
        // ROL: ADMINISTRADOR
        $adminRole = Role::firstOrCreate(['name' => 'administrador']);
        $adminRole->syncPermissions(Permission::all()); // Todos los permisos

        // ROL: JUEZ
        $judgeRole = Role::firstOrCreate(['name' => 'juez']);
        $judgeRole->syncPermissions([
            'view events',
            'view teams',
            'evaluate teams',
            'view evaluations',
            'edit own evaluations',
            'view results',
            'view judge dashboard',
        ]);

        // ROL: PARTICIPANTE
        $participantRole = Role::firstOrCreate(['name' => 'participante']);
        $participantRole->syncPermissions([
            'view events',
            'create teams',
            'edit teams',
            'view teams',
            'join team',
            'view participant dashboard',
        ]);

        // ============= ROLES EXISTENTES (compatibilidad) =============
        // Mantener roles del sistema anterior
        $adminOld = Role::firstOrCreate(['name' => 'admin']);
        $adminOld->syncPermissions(Permission::all());
        
        $judgeOld = Role::firstOrCreate(['name' => 'judge']);
        $judgeOld->syncPermissions($judgeRole->permissions);
        
        $userOld = Role::firstOrCreate(['name' => 'user']);
        $userOld->syncPermissions($participantRole->permissions);

        $this->command->info('✅ Roles y permisos creados/actualizados correctamente');
    }
}