<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Category CRUD Permissions
        // Permission::create(['name' => 'view categories']);
        // Permission::create(['name' => 'create categories']);
        // Permission::create(['name' => 'edit categories']);
        // Permission::create(['name' => 'delete categories']);
        
        // // Post CRUD Permissions
        // Permission::create(['name' => 'view posts']);
        // Permission::create(['name' => 'create posts']);
        // Permission::create(['name' => 'edit posts']);
        // Permission::create(['name' => 'delete posts']);
        
        $adminUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        $normalUser = User::factory()->create([
            'name' => 'Normal User',
            'email' => 'normal@example.com',
            'password' => bcrypt('password'),
        ]);
        
        
        $roleAdmin = Role::create(['name' =>  'admin']);
        
        //Assign All Permissions to Admin
        $adminUser->assignRole($roleAdmin);
        $roleAdmin->syncPermissions(Permission::query()->pluck('name'));
        $normalUser->assignRole(Role::create(['name' => 'user']));
        User::factory(50)->create();
        User::all()->each(function ($user) {
            if (!$user->hasRole('admin')) {
                $user->assignRole('user');
            }
        });
    }
}
