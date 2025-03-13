<?php

namespace Modules\Blog\database\seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Modules\Blog\Article;
use Modules\Blog\Tag;
use Illuminate\Database\Seeder;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = Article::all();
        foreach ($articles as $article) {
            $randomtag = Tag::inRandomOrder()->first();
            $article->tags()->attach($randomtag->id);
        }
    }
}
