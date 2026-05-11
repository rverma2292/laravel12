<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->sentence(),
            'user_name' => $this->faker->name(),
            'post_id' => \App\Models\Post::factory(),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
