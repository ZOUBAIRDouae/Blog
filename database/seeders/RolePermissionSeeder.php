<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $admin = Role::where(['name' => 'admin'])->first();

        // Permission::create(['name' => 'edit']);
        // Permission::create(['name' => 'view public']);
        // $admin->givePermissionTo('edit');


        Role::query()->delete();

                // Créer les rôles
                Role::create(['name' => 'admin']);
                

        Role::updateOrCreate(
            ['name' => 'admin'], // Recherche d'abord par le nom
            ['guard_name' => 'web'] // Assure que le guard_name est bien défini
        );

        Role::updateOrCreate(
            ['name' => 'user'],
            ['guard_name' => 'web']
        );

        



        // Role::findByName('admin')->givePermissionTo(Permission::all());
        // Role::findByName('user')->givePermissionTo(['view public']);

       
    }
}