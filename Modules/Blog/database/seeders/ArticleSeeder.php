<?php

namespace Modules\Blog\database\seeders;

use Modules\Blog\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Article::factory()->count(5)->create();

        
    }
}
