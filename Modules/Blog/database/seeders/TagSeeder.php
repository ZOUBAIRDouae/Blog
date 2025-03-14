<?php

namespace Modules\Blog\Database\Seeders;

use Modules\Blog\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tag = Tag::create([
            'name'  => 'Tag 1',
        ]);

        $tag = Tag::create([
            'name'  => 'Tag 2',
        ]);
    }
}
