<?php

namespace Modules\PkgWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PkgWidget\Models\Apprenant;

class ApprenantSeeder extends Seeder
{
    public function run()
    {
        // Insérer plusieurs apprenants
        Apprenant::create([
            'nom' => 'John Doe',
            'email' => 'john.doe@example.com',
            'actif' => true,
        ]);

        Apprenant::create([
            'nom' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'actif' => true,
        ]);

        Apprenant::create([
            'nom' => 'Alice Johnson',
            'email' => 'alice.johnson@example.com',
            'actif' => false, // Apprenant inactif
        ]);

        Apprenant::create([
            'nom' => 'Bob Brown',
            'email' => 'bob.brown@example.com',
            'actif' => true,
        ]);

        Apprenant::create([
            'nom' => 'Charlie Black',
            'email' => 'charlie.black@example.com',
            'actif' => true,
        ]);
    }
}
