<?php

namespace database\factories\Modules\Blog\Models;


use Modules\Blog\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

use Modules\Blog\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(5),
            'category_id' => $this->faker->numberBetween(1, 10),
            'user_id' => User::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
