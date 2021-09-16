<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->realTextBetween(300, 600),
            'book' => Str::random(10),
            // 'type' => $this->faker->randomElement(['story', 'summary']),
            // 'user_id' => $this->faker->use
        ];
    }
}
