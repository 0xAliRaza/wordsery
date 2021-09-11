<?php

namespace Tests\Feature;

use App\Models\User;
use Inertia\Testing\Assert;
use Tests\TestCase;

class PostCreationTest extends TestCase
{

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
            'content' => '',
            'book' => ''
        ]);
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('posts', [
            'user_id' => $user->id,
            'type' => 'note',
            'content' => '<html><p>test tatti</p></html>',
            'book' => '_-dfljsdflkj38'
        ]);
    }
    public function test_users_can_submit_post()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/post', [
            'type' => 'note',
            'content' => '<html><p>test tatti</p></html>',
            'book' => '_-dfljsdflkj38'
        ]);
        $response->assertRedirect('/home')->assertSessionHas('message');
        $this->assertDatabaseHas('posts', [
            'user_id' => $user->id,
            'type' => 'note',
            'content' => '<html><p>test tatti</p></html>',
            'book' => '_-dfljsdflkj38'
        ]);
    }
}
