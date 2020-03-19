<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LikesTest extends TestCase
{
    use DatabaseMigrations;

    public function testGuestUserCannotLikePost()
    {
        $post = factory(Post::class)->create();

        $response = $this->putJson("post/{$post->id}/like");

        $response->assertStatus(401);
    }

    public function testAuthenticatedUserCanLikePost()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $this->actingAs($user);

        $response = $this->putJson("post/{$post->id}/like");

        $response->assertStatus(200);
        $this->assertCount(1, $post->likes);
        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => Post::class,
        ]);
    }

    public function testAuthenticatedUserCanTogglePostLike()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $this->actingAs($user);

        $expectedData = [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => Post::class,
        ];

        // Likes post
        $response = $this->putJson("post/{$post->id}/like");
        $response->assertOk();

        $this->assertCount(1, $post->likes);
        $this->assertDatabaseHas('likes', $expectedData);

        // Unlikes post
        $response = $this->putJson("post/{$post->id}/like");
        $response->assertOk();

        $post->refresh();

        $this->assertCount(0, $post->likes);
        $this->assertSoftDeleted('likes', $expectedData);

        // Likes again
        $response = $this->putJson("post/{$post->id}/like");
        $response->assertOk();

        $post->refresh();

        $this->assertCount(1, $post->likes);
        $this->assertDatabaseHas('likes', $expectedData);
    }

    public function testCorrectPostLikeCount()
    {
        $users = factory(User::class, 10)->create();
        $post = factory(Post::class)->create();

        $users->map(function ($user) use ($post) {
            $this->actingAs($user);
            $response = $this->putJson("post/{$post->id}/like");
            $response->assertOk();
        });

        $this->assertEquals(10, $post->likesCount);

        // Unlike a post
        $this->actingAs($users->first());
        $response = $this->putJson("post/{$post->id}/like");
        $response->assertOk();

        $this->assertEquals(9, $post->likesCount);
    }
}
