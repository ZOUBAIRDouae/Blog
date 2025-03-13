<?php

namespace Modules\Blog\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Blog\Models\User;

use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Vérifier si l'utilisateur existe
        $user = User::where('email', 'naima@gmail.com')->first();

        User::truncate();


        $user = User::create([
            'name' => 'naima',
            'email' => 'naima@gmail.com',
            'password' => bcrypt('admin1234')]);
            
        $role = Role::findByName('admin', 'web');  // Spécifie le guard
        $user->assignRole('admin');

       
    }
}
