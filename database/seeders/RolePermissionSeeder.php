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

        Permission::create(['name' => 'edit']);
        // Permission::create(['name' => 'view public']);
        $admin->givePermissionTo('edit');

        



        // Role::findByName('admin')->givePermissionTo(Permission::all());
        // Role::findByName('user')->givePermissionTo(['view public']);

       
    }
}