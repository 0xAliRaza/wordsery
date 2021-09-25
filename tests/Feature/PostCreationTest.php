<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use Inertia\Testing\Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_submit_screen_can_be_rendered()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user)->get('/submit');

        $response->assertInertia(fn (Assert $page) => $page->component('Submit'));
    }


    public function test_users_cannot_submit_invalid_post()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/post', [
            'type' => 'invalid',
            'content' => '<p>invalid content</p>',
            'book' => []
        ]);
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('posts', [
            'user_id' => $user->id,
            'type' => 'invalid',
            'content' => '<p>invalid content</p>',
        ]);
    }

    public function test_users_can_submit_post()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/post', [
            'content' => '<p>valid content</p>',
            'type' => 'note',
            'book' => [
                'title' => 'Copyright, Limitations, and the Three-step Test',
                'google_uuid' => '4cMoAQAAMAAJ',
                'subtitle' => 'An Analysis of the Three-step Test in International and EC Copyright Law',
                'publisher' => 'Kluwer Law International',
                'published_date' => 2004,
                'self_link' => 'https://www.googleapis.com/books/v1/volumes/4cMoAQAAMAAJ',
                'thumbnail_link' => 'http://books.google.com/books/content?id=4cMoAQAAMAAJ&printsec=frontcover&img=1&zoom=5&imgtk=AFLRE70VgmbRz4ZdxezqwCHwTHAVvfAdjCGZGBlATpZ4x5V10faMWUtJzuaaoUhYz-o24Ut6_1Yyjr2axFNjJrTICDH4hrew3ObpWMfdct9rJfKIxgr-6pFb7LNYzdPL3tNz0vmPLNpw&source=gbs_api',
                'authors' => ['Martin Senftleben', 'Test author']
            ]
        ]);
        $book = Book::where('google_uuid', '4cMoAQAAMAAJ')->first();

        $this->assertTrue($book && $book->exists());
        $author1 = Author::where('name', 'Martin Senftleben')->first();
        $author2 = Author::where('name', 'Test author')->first();
        $this->assertTrue($author1 && $author2 && $author1->exists() && $author2->exists());

        $response->assertRedirect('/home')->assertSessionHas('message');
        $this->assertDatabaseHas('book_author', ['book_id' => $book->id, 'author_id' => $author1->id])
            ->assertDatabaseHas('book_author', ['book_id' => $book->id, 'author_id' => $author2->id])
            ->assertDatabaseHas('posts', [
                'user_id' => $user->id,
                'type' => 'note',
                'content' => '<p>valid content</p>',
                'book_id' => $book->id,
            ]);
    }
}
