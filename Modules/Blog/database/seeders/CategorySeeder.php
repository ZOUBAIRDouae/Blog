<?php

namespace Modules\Blog\Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\Blog\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $category = Category::create([
            'name'  => 'Category 1',
        ]);

        $category = Category::create([
            'name'  => 'Category 2',
        ]);
        
    }
}
