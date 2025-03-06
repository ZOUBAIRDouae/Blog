<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        $user = User::create([
            'name' => 'douae',
            'email' => 'douae@gmail.com',
            'password' => 'admin']);
        $user->assignRole('admin');

       
    }
}
