<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Inertia\Testing\Assert;

class HomeFeedTest extends TestCase
{

    public function test_home_page_can_be_rendered()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user)->get('/home');

        $response->assertInertia(fn (Assert $page) => $page->component('Home'));
    }


    public function test_user_cannot_get_posts_without_inertia_request()
    {
        $user = User::factory()->create();
        Post::factory()->count(30)->for($user)->state(new Sequence(['type' => 'note'], ['type' => 'summary']))->create();

        $response = $this->actingAs($user)->post('/home');
        $response->assertInertia(
            fn ($page) => $page
                ->missing('posts')
                ->missing('posts.data', 10)
                ->missing('posts.next_page_url')
        );
    }


    // public function test_user_can_get_partially_loaded_posts()
    // {
    //     $user = User::factory()->create();
    //     Post::factory()->count(30)->for($user)->state(new Sequence(['type' => 'note'], ['type' => 'summary']))->create();

    //     $response = $this->actingAs($user)->post('/home', [], ['X-Inertia' => true, 'X-Inertia-Partial-Component' => 'Home', 'X-Inertia-Partial-Data' => 'posts']);
    //     $response->assertInertia(
    //         fn ($page) => $page
    //             ->has('posts')
    //             ->has('posts.data', 10)
    //             ->has('posts.next_page_url')
    //     );
    // }
}
