<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => '$2y$10$RKwa4r0YFC2x366UpPmnueBCDEE/ighATVbtLu9SZ3NFAY5aUg3qi'
        ]);
        Book::factory()->count(50)->has(Author::factory()->count(2))->has(Post::factory()->count(2)->for($user))->create();
    }
}
