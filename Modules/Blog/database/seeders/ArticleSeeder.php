<?php

namespace Modules\Blog\Database\Seeders;

use Modules\Blog\Models\Article;
use Modules\Blog\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $article = Article::create([
            'title' => 'Article 1',
            'content' => 'Content 1',
            'category_id' => 1,
            'user_id' => User::first()->id
        ]);

        $article = Article::create([
            'title' => 'Article 2',
            'content' => 'Content 2',
            'category_id' => 2,
            'user_id' => User::first()->id
        ]);

       

        
    }
}
