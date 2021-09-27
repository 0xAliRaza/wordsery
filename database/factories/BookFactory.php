<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(80),
            'google_uuid' => $this->faker->unique()->uuid(),
            'subtitle' => $this->faker->realTextBetween(150),
            'publisher' => $this->faker->realTextBetween(100, 150),
            'published_date' => $this->faker->year(),
            'self_link' => $this->faker->url(),
            'thumbnail_link' => 'https://source.unsplash.com/random/128x164?' . $this->faker->word(),
            // 'thumbnail_link' => 'https://source.unsplash.com/random/128x164?',
        ];
    }
}
