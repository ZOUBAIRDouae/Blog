<?php

namespace Modules\PkgWidget\Database\Seeders;

use Modules\PkgWidget\Models\Apprenant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;




class DatabaseSeederWidget extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call([
            ApprenantSeeder::class,
        ]);
    }
}
